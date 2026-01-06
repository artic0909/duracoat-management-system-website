<?php

namespace App\Http\Controllers;

use App\Exports\ClientMaterialsInExport;
use App\Mail\DelayAleartMail;
use App\Mail\DeliveryMail;
use App\Models\ClientMaterial;
use App\Models\Jobcard;
use App\Models\Order;
use App\Models\Paint;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Models\JobcardTest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GenericExport;

class ManagerController extends Controller
{

    // Authentication Routes (Manager Guard) =============================================================================================================>
    public function loginView()
    {
        return view('manager.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('manager')->attempt($credentials)) {
            $manager = Auth::guard('manager')->user();

            $request->session()->regenerate();

            return redirect()
                ->route('manager.dashboard')
                ->with('success', 'Welcome back, ' . $manager->name . '!');
        }

        return back()
            ->withErrors(['email' => 'Invalid credentials. Please try again.'])
            ->withInput($request->only('email'));
    }

    public function dashboardView()
    {
        $sumofquantity = Paint::sum('quantity');
        $lowstock = Paint::where('quantity', '>', 0)->where('quantity', '<=', 5)->count();
        $restock = Paint::where('quantity', '<=', 0)->count();

        $totalClients = ClientMaterial::count();
        $totalOrders = Order::count();
        $totalJobcards = Jobcard::count();
        $totalDeliveries = Jobcard::where('jobcard_status', 'delivered')->count();

        $totalTests = JobcardTest::count();

        return view('manager.dashboard', compact('sumofquantity', 'lowstock', 'restock', 'totalClients', 'totalOrders', 'totalJobcards', 'totalDeliveries', 'totalTests'));
    }

    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('manager.login')->with('success', 'Logged out successfully.');
    }
    // Authentication Routes (Manager Guard) =============================================================================================================>



    // Paint Management Routes (Manager Guard) =============================================================================================================>
    public function paintManageView(Request $request)
    {
        $query = Paint::query();

        //Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ral_code', 'like', "%{$search}%")
                    ->orWhere('paint_unique_id', 'like', "%{$search}%")
                    ->orWhere('shade_name', 'like', "%{$search}%")
                    ->orWhere('finish', 'like', "%{$search}%");
            });
        }

        //Stock status filter
        if ($request->has('stock_status') && $request->stock_status !== '') {
            switch ($request->stock_status) {
                case 'out':
                    $query->where('quantity', '<=', 0);
                    break;
                case 'low':
                    $query->where('quantity', '>', 0)->where('quantity', '<=', 5);
                    break;
                case 'in':
                    $query->where('quantity', '>', 5);
                    break;
            }
        }

        $paints = $query->orderBy('id', 'desc')->paginate(8)->appends($request->all());

        return view('manager.paint-manage', compact('paints'));
    }

    public function paintManageStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'ral_code' => 'nullable|string|max:255',
                'brand_name' => 'nullable|string|max:255',
                'shade_name' => 'nullable|string|max:255',
                'finish' => 'nullable|in:plain,texture,structure',
                'quantity' => 'nullable|numeric|min:0',
            ]);

            $validated['paint_unique_id'] = 'PNT-' . strtoupper(uniqid());

            Paint::create($validated);
            return redirect()->back()->with('success', 'Paint added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add paint: ' . $e->getMessage());
        }
    }

    public function paintManageUpdate(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'ral_code' => 'nullable|string|max:255',
                'brand_name' => 'nullable|string|max:255',
                'shade_name' => 'nullable|string|max:255',
                'finish' => 'nullable|in:plain,texture,structure',
                'quantity' => 'nullable|numeric|min:0',
            ]);

            Paint::where('id', $id)->update($validated);
            return redirect()->back()->with('success', 'Paint updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update paint: ' . $e->getMessage());
        }
    }

    public function paintManageDelete($id)
    {
        try {
            Paint::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Paint deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete paint: ' . $e->getMessage());
        }
    }

    public function usedPaints(Request $request)
    {
        $search = $request->input('search');

        $usedPaints = \App\Models\Jobcard::where('jobcard_status', 'delivered')
            ->select(
                'paint_id',
                DB::raw('SUM(paint_used) as total_used_paint'),
                DB::raw('MAX(created_at) as last_created_at'),
                DB::raw('MAX(updated_at) as last_updated_at')
            )
            ->when($search, function ($query, $search) {
                // Filter jobcards by related paint attributes
                $query->whereHas('paint', function ($q) use ($search) {
                    $q->where('ral_code', 'like', "%{$search}%")
                        ->orWhere('paint_unique_id', 'like', "%{$search}%");
                });
            })
            ->with('paint')
            ->groupBy('paint_id')
            ->orderBy('last_updated_at', 'desc')
            ->paginate(8);

        return view('manager.used-paints', compact('usedPaints'));
    }
    // Paint Management Routes (Manager Guard) =============================================================================================================>



    // Clients Management Routes (Manager Guard) =============================================================================================================>
    public function clientManageView(Request $request)
    {
        $paints = Paint::orderBy('id', 'desc')->get();

        $search = $request->input('search');
        $type = $request->input('type');

        $clients = ClientMaterial::query()
            ->when($search, function ($query, $search) {
                $query->where('email', 'like', "%{$search}%")
                    ->orWhere('material_details', 'like', "%{$search}%");
            })
            ->when($type, function ($query, $type) {
                $query->where('material_details', 'like', "%\"type\":\"{$type}\"%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->appends([
                'search' => $search,
                'type' => $type
            ]);

        return view('manager.material-manage', compact('paints', 'clients'));
    }

    public function clientManageStore(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'client_name' => 'required|string|max:255',
                'mobile' => 'nullable|string|max:15',
                'email' => 'nullable|email|max:255',
                'date' => 'required|array',
                'material_type' => 'required|array',
                'material_name' => 'required|array',
                'quantity' => 'required|array',
                'unit' => 'required|array',
                'min_micron' => 'required|array',
                'max_micron' => 'required|array',
                'paint_id' => 'nullable|array',
            ]);

            $uniqueId = 'CLT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

            $materials = [];
            foreach ($request->material_type as $index => $type) {
                if (
                    empty($request->material_name[$index]) &&
                    empty($request->quantity[$index])
                )
                    continue;

                $materials[] = [
                    'date' => $request->date[$index] ?? null,
                    'type' => $type,
                    'material_name' => $request->material_name[$index],
                    'quantity' => $request->quantity[$index],
                    'unit' => $request->unit[$index],
                    'min_micron' => $request->min_micron[$index],
                    'max_micron' => $request->max_micron[$index],
                    'paint_id' => $request->paint_id[$index] ?? null,
                ];
            }

            ClientMaterial::create([
                'client_unique_id' => $uniqueId,
                'client_name' => $request->client_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'material_details' => $materials,
            ]);

            return redirect()->back()->with('success', 'Client added successfully! (ID: ' . $uniqueId . ')');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function clientManageUpdate(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'client_name' => 'required|string|max:255',
                'mobile' => 'nullable|string|max:15',
                'email' => 'nullable|email|max:255',
                'date' => 'required|array',
                'material_type' => 'required|array',
                'material_name' => 'required|array',
                'quantity' => 'required|array',
                'unit' => 'required|array',
                'min_micron' => 'required|array',
                'max_micron' => 'required|array',
                'paint_id' => 'nullable|array',
            ]);

            $materials = [];
            foreach ($request->material_type as $index => $type) {
                if (
                    empty($request->material_name[$index]) &&
                    empty($request->quantity[$index])
                )
                    continue;

                $materials[] = [
                    'date' => $request->date[$index] ?? null,
                    'type' => $type,
                    'material_name' => $request->material_name[$index],
                    'quantity' => $request->quantity[$index],
                    'unit' => $request->unit[$index],
                    'min_micron' => $request->min_micron[$index],
                    'max_micron' => $request->max_micron[$index],
                    'paint_id' => $request->paint_id[$index] ?? null,
                ];
            }

            ClientMaterial::where('id', $id)->update([
                'client_name' => $request->client_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'material_details' => $materials,
            ]);

            return redirect()->back()->with('success', 'Client updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function clientManageDelete($id)
    {
        try {
            ClientMaterial::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Client deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    // Clients Management Routes (Manager Guard) =============================================================================================================>

    // Orders & Jobcards Management Routes (Manager Guard) =============================================================================================================>
    public function orderCreateView(Request $request)
    {
        $query = Order::with('client')->orderBy('id', 'desc');

        //Filter by order number
        if ($request->order_number) {
            $query->where('order_number', 'like', '%' . $request->order_number . '%');
        }

        //Filter by date range
        if ($request->from_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->from_date, $request->end_date]);
        } elseif ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        } elseif ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $orders = $query->paginate(8);
        $clients = ClientMaterial::orderBy('id', 'desc')->get()->map(function ($client) {
            if (is_string($client->material_details)) {
                $client->material_details = json_decode($client->material_details, true);
            }
            return $client;
        });


        $jobcardsCountPerticularOrder = [];
        foreach ($orders as $order) {
            $jobcardsCountPerticularOrder[$order->id] = Jobcard::where('order_id', $order->id)->count();
        }

        return view('manager.order-create', compact('clients', 'orders', 'jobcardsCountPerticularOrder'));
    }

    public function orderCreateStore(Request $request)
    {
        try {

            $request->validate([
                'client_id' => 'required|exists:client_materials,id',
                'order_number' => 'required|string|max:255|unique:orders,order_number',
            ]);

            $order = Order::create([
                'client_id' => $request->client_id,
                'order_number' => $request->order_number,
            ]);

            if ($order) {
                return redirect()->back()->with('success', 'Order created successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to create order. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function orderCreateUpdate(Request $request, $id)
    {
        try {
            $request->validate([
                'client_id' => 'required|exists:client_materials,id',
                'order_number' => 'required|string|max:255|unique:orders,order_number,' . $id,
            ]);

            $order = Order::findOrFail($id);

            $order->update([
                'client_id' => $request->client_id,
                'order_number' => $request->order_number,
            ]);

            return redirect()->back()->with('success', 'Order updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Order update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function orderCreateDelete($id)
    {
        try {
            Order::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }

    // Add Jobcard
    public function addJobcardView($order_id)
    {
        try {
            $order = Order::with('client')->findOrFail($order_id);

            $clientMaterialsRaw = $order->client->material_details;

            if (is_string($clientMaterialsRaw)) {
                $clientMaterials = json_decode($clientMaterialsRaw, true) ?? [];
            } elseif (is_array($clientMaterialsRaw)) {
                $clientMaterials = $clientMaterialsRaw;
            } else {
                $clientMaterials = [];
            }

            // Fetch all paint records
            $paints = Paint::all(['id', 'ral_code', 'quantity'])->keyBy('id');

            // Replace paint_id with paint details (RAL code & name)
            $clientMaterials = collect($clientMaterials)->map(function ($mat) use ($paints) {
                // Handle case where paint_id might be missing or null
                $paintId = $mat['paint_id'] ?? null;
                $paint = $paintId ? $paints->get($paintId) : null;

                // Extract additional details from material
                // Note: 'date' might be stored in the material array, check its key key
                $date = $mat['date'] ?? null;
                $minMicron = $mat['min_micron'] ?? null;
                $maxMicron = $mat['max_micron'] ?? null;

                return [
                    'type' => $mat['type'] ?? '',
                    'material_name' => $mat['material_name'] ?? '',
                    'quantity' => $mat['quantity'] ?? '',
                    'unit' => $mat['unit'] ?? '',
                    'paint_id' => $paintId,
                    'paint_code' => $paint ? $paint->ral_code : 'N/A',
                    'date' => $date, // Add date
                    'min_micron' => $minMicron, // Add min_micron
                    'max_micron' => $maxMicron, // Add max_micron
                ];
            })->toArray();


            return view('manager.add-jobcard', compact('order', 'clientMaterials'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load jobcard page: ' . $e->getMessage());
        }
    }

    public function addJobcardStore(Request $request, $order_id)
    {
        try {
            $request->validate([
                'jobcard_creation_date' => 'required|date',
                'jobcard_number' => 'required|string|max:255|unique:jobcards,jobcard_number',
                'selected_material' => 'required',
                'material_type' => 'required|string',
                'material_name' => 'required|string',
                'material_quantity' => 'required|numeric',
                'material_unit' => 'required|string',
                'paint_id' => 'nullable|exists:paints,id',
                'ral_code' => 'nullable|string',
                'min_micron' => 'nullable|string', // Validating min_micron
                'max_micron' => 'nullable|string', // Validating max_micron
            ]);

            $order = Order::with('client')->findOrFail($order_id);

            Jobcard::create([
                'order_id' => $order->id,
                'client_id' => $order->client->id,
                'jobcard_creation_date' => $request->jobcard_creation_date,
                'jobcard_number' => $request->jobcard_number,
                'material_type' => $request->material_type,
                'material_name' => $request->material_name,
                'material_quantity' => $request->material_quantity,
                'material_unit' => $request->material_unit,
                'paint_id' => $request->paint_id,
                'ral_code' => $request->ral_code,
                'min_micron' => $request->min_micron, // Storing min_micron
                'max_micron' => $request->max_micron, // Storing max_micron
                'jobcard_status' => 'pending',
            ]);

            return redirect()->route('manager.view-created-jobcards', $order->id)->with('success', 'Jobcard created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create jobcard: ' . $e->getMessage());
        }
    }

    public function addJobcardDelete($id)
    {
        try {
            Jobcard::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Jobcard deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete jobcard: ' . $e->getMessage());
        }
    }

    // Edit Jobcard
    public function editJobcardView($id)
    {
        $jobcard = Jobcard::with('client')->findOrFail($id); // Eager load client
        $order = $jobcard->order; // Get order via relationship if available, or fetch using order_id

        // Re-use logic to get client materials (similar to addJobcardView)
        $clientMaterialsRaw = $jobcard->client->material_details ?? [];

        if (is_string($clientMaterialsRaw)) {
            $clientMaterials = json_decode($clientMaterialsRaw, true) ?? [];
        } elseif (is_array($clientMaterialsRaw)) {
            $clientMaterials = $clientMaterialsRaw;
        } else {
            $clientMaterials = [];
        }

        // Fetch all paint records
        $paints = Paint::all(['id', 'ral_code', 'quantity'])->keyBy('id');

        // Replace paint_id with paint details (RAL code & name)
        $clientMaterials = collect($clientMaterials)->map(function ($mat) use ($paints) {
            // Handle case where paint_id might be missing or null
            $paintId = $mat['paint_id'] ?? null;
            $paint = $paintId ? $paints->get($paintId) : null;

            // Extract additional details from material
            $date = $mat['date'] ?? null;
            $minMicron = $mat['min_micron'] ?? null;
            $maxMicron = $mat['max_micron'] ?? null;

            return [
                'type' => $mat['type'] ?? '',
                'material_name' => $mat['material_name'] ?? '',
                'quantity' => $mat['quantity'] ?? '',
                'unit' => $mat['unit'] ?? '',
                'paint_id' => $paintId,
                'paint_code' => $paint ? $paint->ral_code : 'N/A',
                'date' => $date,
                'min_micron' => $minMicron,
                'max_micron' => $maxMicron,
            ];
        })->toArray();

        return view('manager.edit-jobcard', compact('jobcard', 'clientMaterials'));
    }

    public function updateJobcard(Request $request, $id)
    {
        $jobcard = Jobcard::findOrFail($id);

        // Step 1: Update jobcard fields
        $jobcard->update([
            'jobcard_number' => $request->jobcard_number,
            'material_type' => $request->material_type,
            'material_name' => $request->material_name,
            'material_quantity' => $request->material_quantity,
            'material_unit' => $request->material_unit,
            'ral_code' => $request->ral_code,
            'paint_id' => $request->paint_id,
            'paint_used' => $request->paint_used,
            'min_micron' => $request->min_micron,
            'max_micron' => $request->max_micron,
        ]);

        // Step 2: Deduct paint quantity if paint_used is provided
        if ($request->paint_used && $request->paint_used > 0 && $jobcard->paint_id) {

            $paint = Paint::find($jobcard->paint_id);

            if ($paint) {
                //Deduct paint quantity (allow negatives)
                $paint->quantity = $paint->quantity - $request->paint_used;
                $paint->save();
            }
        }

        // Step 3: Redirect back
        return redirect()
            ->route('manager.view-created-jobcards', $jobcard->order_id)
            ->with('success', 'Jobcard updated and paint stock adjusted successfully!');
    }

    public function viewCreatedJobcards($order_id)
    {
        $order = Order::with('client')->findOrFail($order_id);
        // $jobcards = Jobcard::where('order_id', $order_id)->orderBy('id', 'desc')->get();

        $jobcards = Jobcard::with('tests')
            ->where('order_id', $order_id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('manager.view-jobcard-details', compact('order', 'jobcards'));
    }

    public function updatePretreatment($id)
    {
        $jobcard = Jobcard::findOrFail($id);
        $jobcard->update([
            'pre_treatment_date' => Carbon::today(),
            'jobcard_status' => 'pre-treatment',
        ]);

        return redirect()->back()->with('success', 'Pre-Treatment marked for today!');
    }

    public function updatePowderApplied($id)
    {
        $jobcard = Jobcard::findOrFail($id);

        // ensure pre-treatment date exists first
        if (!$jobcard->pre_treatment_date) {
            return redirect()->back()->with('error', 'Please mark Pre-Treatment before Powder Application.');
        }

        $preTreatmentDate = Carbon::parse($jobcard->pre_treatment_date);
        $today = Carbon::today();
        $diffDays = $preTreatmentDate->diffInDays($today);

        if ($diffDays > 5) {
            // send alert email
            Mail::to('arif@rconpl.in')->cc('rakibul@rconpl.in')->send(new DelayAleartMail($jobcard, $diffDays));

            // don’t update date, show error
            return redirect()->back()->with('error', 'Powder Application delayed by more than 5 days! Alert sent to admin.');
        }

        // within 5 days → update normally
        $jobcard->update([
            'powder_apply_date' => $today,
            'jobcard_status' => 'powder-applied',
        ]);

        return redirect()->back()->with('success', 'Powder Application marked for today!');
    }

    // public function updateDelivered($id)
    // {
    //     $jobcard = Jobcard::findOrFail($id);

    //     $jobcard->update([
    //         'delivery_date' => Carbon::today(),
    //         'jobcard_status' => 'delivered',
    //     ]);

    //     $mailData = [
    //         'type' => 'delivered',
    //         'delivered_at' => Carbon::today(),
    //     ];

    //     Mail::to('arif@rconpl.in')
    //         ->cc('rakibul@rconpl.in')
    //         ->send(new DeliveryMail($jobcard, $mailData));

    //     return redirect()->back()->with('success', 'Jobcard marked as delivered today and notification sent!');
    // }

    public function updateDelivered(Request $request, $id)
    {
        $request->validate([
            'invoice' => 'required|string|max:255',
        ]);

        $jobcard = Jobcard::findOrFail($id);

        // get client data
        $client = ClientMaterial::find($jobcard->client_id);

        if (!$client) {
            return redirect()->back()->with('error', 'Client not found for this jobcard.');
        }

        $jobcard->update([
            'delivery_date' => Carbon::today(),
            'jobcard_status' => 'delivered',
            'invoice' => $request->invoice,
        ]);

        $mailData = [
            'type' => 'delivered',
            'delivered_at' => Carbon::today(),
        ];
        // send delivery mail to client + CC 2 fixed emails
        Mail::to($client->email)
            ->cc(['arif@rconpl.in', 'rakibul@rconpl.in'])
            ->send(new DeliveryMail($jobcard, $mailData));
        return redirect()->back()->with('success', 'Jobcard delivered & notification sent to client!');
    }

    public function updateDeliveryStatement(Request $request, $id)
    {
        $request->validate([
            'delivery_statement' => 'required|string',
            'invoice' => 'required|string|max:255',
        ]);

        $jobcard = Jobcard::findOrFail($id);

        // fetch client email using client_id
        $client = ClientMaterial::find($jobcard->client_id);

        if (!$client) {
            return redirect()->back()->with('error', 'Client not found for this jobcard.');
        }

        // update statement & status
        $jobcard->update([
            'delivery_statement' => $request->delivery_statement,
            'jobcard_status' => 'delivered',
            'invoice' => $request->invoice,
        ]);

        $mailData = [
            'type' => 'statement',
            'delivery_statement' => $request->delivery_statement,
        ];

        // send to client + CC to arif & rakibul
        Mail::to($client->email)
            ->cc(['arif@rconpl.in', 'rakibul@rconpl.in'])
            ->send(new DeliveryMail($jobcard, $mailData));

        return redirect()->back()->with('success', 'Delivery statement updated and notification sent to client!');
    }


    // Tests Management Routes
    public function jobcardTestsView($id)
    {
        $jobcard = Jobcard::with('order', 'client')->findOrFail($id);
        $existingTest = JobcardTest::where('jobcard_id', $id)->first();

        return view('manager.jobcard-test', compact('jobcard', 'existingTest'));
    }

    public function jobcardTestStoreAndEdit(Request $request, $id)
    {
        $jobcard = Jobcard::with('order', 'client')->findOrFail($id);

        $request->validate([
            'substrateInput' => 'nullable|string',
            'substrateResult' => 'nullable|string',
            'filmThicknessInput' => 'nullable|string',
            'filmThicknessResult' => 'nullable|string',
            'bakingTempInput' => 'nullable|string',
            'bakingTempResult' => 'nullable|string',
            'bakingTimeInput' => 'nullable|string',
            'bakingTimeResult' => 'nullable|string',
            'colourUniformityInput' => 'nullable|string',
            'colourUniformityResult' => 'nullable|string',
            'mekRubsInput' => 'nullable|string',
            'mekPeelInput' => 'nullable|string',
            'mekResult' => 'nullable|string',
            'crossHatchInput' => 'nullable|string',
            'crossHatchResult' => 'nullable|string',
            'mandrelInput' => 'nullable|string',
            'mandrelResult' => 'nullable|string',
            'pencilHardnessInput' => 'nullable|string',
            'pencilHardnessResult' => 'nullable|string',
        ]);

        $today = Carbon::today()->format('Y-m-d');

        $testing = [
            [
                'test_name' => 'Substrate',
                'test_value' => $request->substrateInput,
                'test_result' => $request->substrateResult,
            ],
            [
                'test_name' => 'Dry filmThickness',
                'test_value' => $request->filmThicknessInput,
                'test_result' => $request->filmThicknessResult,
            ],
            [
                'test_name' => 'Baking Temperature',
                'test_value' => $request->bakingTempInput,
                'test_result' => $request->bakingTempResult,
            ],
            [
                'test_name' => 'Baking Time',
                'test_value' => $request->bakingTimeInput,
                'test_result' => $request->bakingTimeResult,
            ],
            [
                'test_name' => 'Colour Uniformity Test',
                'test_value' => $request->colourUniformityInput,
                'test_result' => $request->colourUniformityResult,
            ],
            [
                'test_name' => 'M E K Test',
                'test_value' => $request->mekRubsInput . ' Rubs | Peel: ' . $request->mekPeelInput,
                'rubs_value' => $request->mekRubsInput, // Optional extra storage if needed
                'peel_value' => $request->mekPeelInput,    // Optional
                'test_result' => $request->mekResult,
            ],
            [
                'test_name' => 'Cross Hatch Test',
                'test_value' => $request->crossHatchInput,
                'test_result' => $request->crossHatchResult,
            ],
            [
                'test_name' => 'Conical Mandrel Test',
                'test_value' => $request->mandrelInput,
                'test_result' => $request->mandrelResult,
            ],
            [
                'test_name' => 'Pencil Hardness Test',
                'test_value' => $request->pencilHardnessInput,
                'test_result' => $request->pencilHardnessResult,
            ],
        ];

        //Check if a test already exists for this jobcard
        $existingTest = JobcardTest::where('jobcard_id', $jobcard->id)->first();

        if ($existingTest) {
            //Update existing record
            $existingTest->update([
                'testing' => $testing,
                'test_date' => $today,
            ]);
        } else {
            //Create new record
            JobcardTest::create([
                'jobcard_id' => $jobcard->id,
                'order_id' => $jobcard->order_id,
                'client_id' => $jobcard->client_id,
                'testing' => $testing,
                'test_date' => $today,
            ]);
        }

        return redirect()->route('manager.view-created-jobcards', $jobcard->order_id)
            ->with('success', 'QC Test Results Saved Successfully!');
    }

    public function downloadJobCardInPDF($id)
    {
        $jobcard = Jobcard::with('order.client')->findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.jobcard', [
            'jobcard' => $jobcard,
        ])->setPaper('a4');

        return $pdf->download('JobCard_' . $jobcard->jobcard_number . '.pdf');
    }

    public function viewJobCard($id)
    {
        $jobcard = Jobcard::with('order.client')->findOrFail($id);

        return view('pdf.jobcard', compact('jobcard'));
    }

    public function downloadJobcardTestResultsInPDF($id)
    {
        // Get jobcard with related test data
        $jobcard = Jobcard::with(['tests'])->findOrFail($id);
        $test = $jobcard->tests->first(); // assuming one test record per jobcard

        // If no test record exists
        if (!$test) {
            return back()->with('error', 'No test results found for this Jobcard.');
        }

        // Prepare data for PDF
        $data = [
            'jobcard' => $jobcard,
            'test' => $test,
            'testing' => $test->testing,
        ];

        // Load Blade view
        $pdf = Pdf::loadView('pdf.jobcard-test-result', $data);

        // Download PDF
        return $pdf->download('QC_Test_Result_Jobcard_' . $jobcard->jobcard_number . '.pdf');
    }
    // Orders & Jobcards Management Routes (Manager Guard) =============================================================================================================>



    // All Jobcards Management Routes (Manager Guard) =============================================================================================================>
    public function allJobcardsView(Request $request)
    {
        $query = Jobcard::with('order.client')->orderBy('id', 'desc');

        if ($request->filled('jobcard_number')) {
            $query->where('jobcard_number', 'like', '%' . $request->jobcard_number . '%');
        }

        if ($request->filled('from_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->end_date]);
        } elseif ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $jobcards = $query->paginate(5);

        return view('manager.all-jobcards', compact('jobcards'));
    }

    // Material Out Management Routes (Manager Guard) =============================================================================================================>
    public function materialOutView(Request $request)
    {
        $query = Jobcard::with('order.client')->where('jobcard_status', 'delivered')->orderBy('id', 'desc');

        if ($request->filled('order_number')) {
            $search = $request->order_number;

            $query->where(function ($q) use ($search) {
                $q->where('jobcard_number', 'like', '%' . $search . '%')
                    ->orWhereHas('order', function ($sub) use ($search) {
                        $sub->where('order_number', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->filled('from_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->end_date]);
        } elseif ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $jobcards = $query->paginate(8);

        return view('manager.material-out', compact('jobcards'));
    }

    // Manage Stock Routes (Manager Guard) =============================================================================================================>
    public function stockManageView(Request $request)
    {
        $query = Paint::query();

        //Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ral_code', 'like', "%{$search}%")
                    ->orWhere('paint_unique_id', 'like', "%{$search}%")
                    ->orWhere('shade_name', 'like', "%{$search}%")
                    ->orWhere('finish', 'like', "%{$search}%");
            });
        }

        //Stock status filter
        if ($request->has('stock_status') && $request->stock_status !== '') {
            switch ($request->stock_status) {
                case 'out':
                    $query->where('quantity', '<=', 0);
                    break;
                case 'low':
                    $query->where('quantity', '>', 0)->where('quantity', '<=', 5);
                    break;
                case 'in':
                    $query->where('quantity', '>', 5);
                    break;
            }
        }

        $paints = $query->orderBy('id', 'desc')->paginate(10)->appends($request->all());

        return view('manager.stock-manage', compact('paints'));
    }

    public function stockUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:paints,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $paint = Paint::findOrFail($request->id);
        $paint->quantity += $request->quantity;
        $paint->save();

        return redirect()->back()->with('success', 'Stock updated successfully.');
    }

    // Profile Management Routes (Manager Guard) =============================================================================================================>
    public function profileView()
    {
        return view('manager.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::guard('manager')->user();

        $user->name = $request->name;
        $user->email = $request->email;

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    // Export in Excel =============================================================================================================>
    public function exportPaintsToExcel(Request $request)
    {
        $paints = DB::table('paints')
            ->select('paint_unique_id', 'brand_name', 'ral_code', 'shade_name', 'finish', 'quantity')
            ->orderBy('id', 'desc')
            ->get();

        $data = $paints->map(function ($item) {
            // Determine stock status based on quantity
            if ($item->quantity <= 0) {
                $stockStatus = 'Out of Stock';
            } elseif ($item->quantity <= 5) {
                $stockStatus = 'Low Stock';
            } else {
                $stockStatus = 'In Stock';
            }

            return [
                'Paint Unique ID' => $item->paint_unique_id,
                'Brand Name' => $item->brand_name,
                'RAL Code' => $item->ral_code,
                'Shade Name' => $item->shade_name,
                'Finish' => $item->finish,
                'Quantity' => $item->quantity,
                'Unit' => 'Kg',
                'Status' => $stockStatus,
            ];
        });

        $headings = [
            'Paint Unique ID',
            'Brand Name',
            'RAL Code',
            'Shade Name',
            'Finish',
            'Quantity',
            'Unit',
            'Status',
        ];

        return Excel::download(new GenericExport($data, $headings), 'paints_export.xlsx');
    }

    public function exportJobcardsToExcel(Request $request)
    {
        // Join jobcards with orders to get order_number
        $jobcards = DB::table('jobcards')
            ->join('orders', 'jobcards.order_id', '=', 'orders.id')
            ->select(
                'jobcards.jobcard_creation_date',
                'orders.order_number',
                'jobcards.jobcard_number',
                'jobcards.material_type',
                'jobcards.material_name',
                'jobcards.material_quantity',
                'jobcards.material_unit',
                'jobcards.paint_used',
                'jobcards.jobcard_status',
                'jobcards.pre_treatment_date',
                'jobcards.powder_apply_date',
                'jobcards.delivery_date',
                'jobcards.delivery_statement',
                'jobcards.created_at'
            )
            ->orderBy('jobcards.id', 'desc')
            ->get();

        // Map the data for export
        $data = $jobcards->map(function ($item) {
            return [
                'Creation Date' => $item->jobcard_creation_date,
                'Order Number' => $item->order_number,
                'Jobcard Number' => $item->jobcard_number,
                'Material Type' => $item->material_type,
                'Material Name' => $item->material_name,
                'Quantity' => $item->material_quantity,
                'Unit' => $item->material_unit,
                'Paint Used' => $item->paint_used,
                'Status' => ucfirst($item->jobcard_status),
                'Pre-Treatment Date' => $item->pre_treatment_date,
                'Powder Apply Date' => $item->powder_apply_date,
                'Delivery Date' => $item->delivery_date,
                'Delivery Statement' => $item->delivery_statement,
                'Created At' => $item->created_at,
            ];
        });

        // Headings for Excel file
        $headings = [
            'Creation Date',
            'Order Number',
            'Jobcard Number',
            'Material Type',
            'Material Name',
            'Quantity',
            'Unit',
            'Paint Used',
            'Status',
            'Pre-Treatment Date',
            'Powder Apply Date',
            'Delivery Date',
            'Delivery Statement',
            'Created At',
        ];

        // Export as Excel file
        return Excel::download(new GenericExport($data, $headings), 'jobcards_export.xlsx');
    }

    public function exportOrdersToExcel(Request $request)
    {
        $orders = DB::table('orders')
            ->join('client_materials', 'orders.client_id', '=', 'client_materials.id')
            ->select('orders.order_number', 'client_materials.client_name', 'client_materials.email', 'client_materials.mobile', 'orders.created_at')
            ->orderBy('orders.id', 'desc')
            ->get();

        $data = $orders->map(function ($item) {
            return [
                'Order Number' => $item->order_number,
                'Client Name' => $item->client_name,
                'Email' => $item->email,
                'Mobile' => $item->mobile,
                'Created At' => $item->created_at,
            ];
        });

        $headings = ['Order Number', 'Client Name', 'Email', 'Mobile', 'Created At'];

        return Excel::download(new GenericExport($data, $headings), 'orders_export.xlsx');
    }

    public function exportClientAndMaterialsInToExcel(Request $request)
    {
        return Excel::download(new ClientMaterialsInExport, 'client_materials_in.xlsx');
    }

    public function exportClientAndMaterialsOutToExcel(Request $request)
    {
        // Fetch only delivered jobcards and join with orders
        $jobcards = DB::table('jobcards')
            ->join('orders', 'jobcards.order_id', '=', 'orders.id')
            ->select(
                'jobcards.jobcard_creation_date',
                'orders.order_number',
                'jobcards.jobcard_number',
                'jobcards.material_type',
                'jobcards.material_name',
                'jobcards.material_quantity',
                'jobcards.material_unit',
                'jobcards.paint_used',
                'jobcards.jobcard_status',
                'jobcards.pre_treatment_date',
                'jobcards.powder_apply_date',
                'jobcards.delivery_date',
                'jobcards.delivery_statement',
                'jobcards.created_at'
            )
            ->where('jobcards.jobcard_status', '=', 'delivered')
            ->orderBy('jobcards.id', 'desc')
            ->get();

        // Map the data for Excel
        $data = $jobcards->map(function ($item) {
            return [
                'Creation Date' => $item->jobcard_creation_date,
                'Order Number' => $item->order_number,
                'Jobcard Number' => $item->jobcard_number,
                'Material Type' => $item->material_type,
                'Material Name' => $item->material_name,
                'Quantity' => $item->material_quantity,
                'Unit' => $item->material_unit,
                'Paint Used' => $item->paint_used,
                'Status' => ucfirst($item->jobcard_status),
                'Pre-Treatment Date' => $item->pre_treatment_date,
                'Powder Apply Date' => $item->powder_apply_date,
                'Delivery Date' => $item->delivery_date,
                'Delivery Statement' => $item->delivery_statement,
                'Created At' => $item->created_at,
            ];
        });

        // Headings for Excel export
        $headings = [
            'Creation Date',
            'Order Number',
            'Jobcard Number',
            'Material Type',
            'Material Name',
            'Quantity',
            'Unit',
            'Paint Used',
            'Status',
            'Pre-Treatment Date',
            'Powder Apply Date',
            'Delivery Date',
            'Delivery Statement',
            'Created At',
        ];

        // Download Excel
        return Excel::download(new GenericExport($data, $headings), 'client_materials_out.xlsx');
    }
}
