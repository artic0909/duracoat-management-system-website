<?php

namespace App\Http\Controllers;

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
use App\Mail\DelayAlertMail;
use App\Models\JobcardTest;
use Illuminate\Support\Facades\DB;

class ViewerController extends Controller
{

    // Authentication Routes (Manager Guard) =============================================================================================================>
    public function loginView()
    {
        return view('viewer.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('viewer')->attempt($credentials)) {
            $manager = Auth::guard('viewer')->user();

            $request->session()->regenerate();

            return redirect()
                ->route('viewer.dashboard')
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

        return view('viewer.dashboard', compact('sumofquantity', 'lowstock', 'restock', 'totalClients', 'totalOrders', 'totalJobcards', 'totalDeliveries', 'totalTests'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('viewer.login')->with('success', 'Logged out successfully.');
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

        return view('viewer.paint-manage', compact('paints'));
    }

    public function paintManageStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'ral_code'   => 'nullable|string|max:255',
                'brand_name' => 'nullable|string|max:255',
                'shade_name' => 'nullable|string|max:255',
                'finish'     => 'nullable|in:plain,texture,structure',
                'quantity'   => 'nullable|numeric|min:0',
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
                'ral_code'   => 'nullable|string|max:255',
                'brand_name' => 'nullable|string|max:255',
                'shade_name' => 'nullable|string|max:255',
                'finish'     => 'nullable|in:plain,texture,structure',
                'quantity'   => 'nullable|numeric|min:0',
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

        return view('viewer.used-paints', compact('usedPaints'));
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
            ->paginate(5)
            ->appends([
                'search' => $search,
                'type' => $type
            ]);

        return view('viewer.material-manage', compact('paints', 'clients'));
    }

    public function clientManageStore(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'client_name'   => 'required|string|max:255',
                'mobile'        => 'nullable|string|max:15',
                'email'         => 'nullable|email|max:255',
                'material_type' => 'required|array',
                'material_name' => 'required|array',
                'quantity'      => 'required|array',
                'unit'          => 'required|array',
                'paint_id'      => 'required|array',
            ]);

            $uniqueId = 'CLT-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));

            $materials = [];
            foreach ($request->material_type as $index => $type) {
                if (
                    empty($request->material_name[$index]) &&
                    empty($request->quantity[$index])
                ) continue;

                $materials[] = [
                    'type'          => $type,
                    'material_name' => $request->material_name[$index],
                    'quantity'      => $request->quantity[$index],
                    'unit'          => $request->unit[$index],
                    'paint_id'      => $request->paint_id[$index],
                ];
            }

            ClientMaterial::create([
                'client_unique_id' => $uniqueId,
                'client_name'      => $request->client_name,
                'mobile'           => $request->mobile,
                'email'            => $request->email,
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
                'client_name'   => 'required|string|max:255',
                'mobile'        => 'nullable|string|max:15',
                'email'         => 'nullable|email|max:255',
                'material_type' => 'required|array',
                'material_name' => 'required|array',
                'quantity'      => 'required|array',
                'unit'          => 'required|array',
                'paint_id'      => 'required|array',
            ]);

            $materials = [];
            foreach ($request->material_type as $index => $type) {
                if (
                    empty($request->material_name[$index]) &&
                    empty($request->quantity[$index])
                ) continue;

                $materials[] = [
                    'type'          => $type,
                    'material_name' => $request->material_name[$index],
                    'quantity'      => $request->quantity[$index],
                    'unit'          => $request->unit[$index],
                    'paint_id'      => $request->paint_id[$index],
                ];
            }

            ClientMaterial::where('id', $id)->update([
                'client_name'      => $request->client_name,
                'mobile'           => $request->mobile,
                'email'            => $request->email,
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
        $clients = ClientMaterial::orderBy('id', 'desc')->get();

        $jobcardsCountPerticularOrder = [];
        foreach ($orders as $order) {
            $jobcardsCountPerticularOrder[$order->id] = Jobcard::where('order_id', $order->id)->count();
        }

        return view('viewer.order-create', compact('clients', 'orders', 'jobcardsCountPerticularOrder'));
    }

    public function orderCreateStore(Request $request)
    {
        try {

            $request->validate([
                'client_id'     => 'required|exists:client_materials,id',
                'order_number'  => 'required|string|max:255|unique:orders,order_number',
            ]);

            $order = Order::create([
                'client_id'    => $request->client_id,
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
                'client_id'     => 'required|exists:client_materials,id',
                'order_number'  => 'required|string|max:255|unique:orders,order_number,' . $id,
            ]);

            $order = Order::findOrFail($id);

            $order->update([
                'client_id'    => $request->client_id,
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
                $paint = $paints->get($mat['paint_id']);
                return [
                    'type'          => $mat['type'] ?? '',
                    'material_name' => $mat['material_name'] ?? '',
                    'quantity'      => $mat['quantity'] ?? '',
                    'unit'          => $mat['unit'] ?? '',
                    'paint_id'      => $mat['paint_id'] ?? '',
                    'paint_code'    => $paint->ral_code ?? 'N/A',
                ];
            })->toArray();

            return view('viewer.add-jobcard', compact('order', 'clientMaterials'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load jobcard page: ' . $e->getMessage());
        }
    }

    public function addJobcardStore(Request $request, $order_id)
    {
        try {
            $request->validate([
                'jobcard_creation_date' => 'required|date',
                'jobcard_number'        => 'required|string|max:255|unique:jobcards,jobcard_number',
                'selected_material'     => 'required',
                'material_type'         => 'required|string',
                'material_name'         => 'required|string',
                'material_quantity'     => 'required|numeric',
                'material_unit'         => 'required|string',
                'paint_id'              => 'required|exists:paints,id',
                'ral_code'              => 'nullable|string',
            ]);

            $order = Order::with('client')->findOrFail($order_id);

            Jobcard::create([
                'order_id'              => $order->id,
                'client_id'             => $order->client->id,
                'jobcard_creation_date' => $request->jobcard_creation_date,
                'jobcard_number'        => $request->jobcard_number,
                'material_type'         => $request->material_type,
                'material_name'         => $request->material_name,
                'material_quantity'     => $request->material_quantity,
                'material_unit'         => $request->material_unit,
                'paint_id'              => $request->paint_id,
                'ral_code'              => $request->ral_code,
                'jobcard_status'        => 'pending',
            ]);

            return redirect()->route('viewer.view-created-jobcards', $order->id)->with('success', 'Jobcard created successfully!');
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
        $jobcard = Jobcard::findOrFail($id);
        return view('viewer.edit-jobcard', compact('jobcard'));
    }

    public function updateJobcard(Request $request, $id)
    {
        $jobcard = Jobcard::findOrFail($id);

        // Step 1: Update jobcard fields
        $jobcard->update([
            'jobcard_number' => $request->jobcard_number,
            'paint_used'     => $request->paint_used,
            'paint_id'       => $request->paint_id,
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
            ->route('viewer.view-created-jobcards', $jobcard->order_id)
            ->with('success', 'Jobcard updated and paint stock adjusted successfully!');
    }

    public function viewCreatedJobcards($order_id)
    {
        $order = Order::with('client')->findOrFail($order_id);
        // $jobcards = Jobcard::where('order_id', $order_id)->orderBy('id', 'desc')->get();

        $jobcards = Jobcard::with('tests')
            ->where('order_id', $order_id)
            ->orderBy('id', 'desc')
            ->get();

        return view('viewer.view-jobcard-details', compact('order', 'jobcards'));
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
        $jobcard->update([
            'powder_apply_date' => Carbon::today(),
            'jobcard_status' => 'powder-applied',
        ]);

        return redirect()->back()->with('success', 'Powder Application marked for today!');
    }

    public function updateDelivered($id)
    {
        $jobcard = Jobcard::findOrFail($id);
        $jobcard->update([
            'delivery_date' => Carbon::today(),
            'jobcard_status' => 'delivered',
        ]);

        return redirect()->back()->with('success', 'Jobcard marked as delivered today!');
    }

    // Tests Management Routes
    public function jobcardTestsView($id)
    {
        $jobcard = Jobcard::with('order', 'client')->findOrFail($id);
        $existingTest = JobcardTest::where('jobcard_id', $id)->first();

        return view('viewer.jobcard-test', compact('jobcard', 'existingTest'));
    }

    public function jobcardTestStoreAndEdit(Request $request, $id)
    {
        $jobcard = Jobcard::with('order', 'client')->findOrFail($id);

        $request->validate([
            'adhesionInput' => 'nullable|string|max:10',
            'adhesionResult' => 'nullable|string|max:255',
            'hardnessInput' => 'nullable|string|max:10',
            'hardnessResult' => 'nullable|string|max:255',
            'impactInput' => 'nullable|numeric',
            'impactResult' => 'nullable|string|max:255',
            'bendInput' => 'nullable|string|max:255',
            'bendResult' => 'nullable|string|max:255',
            'cuppingInput' => 'nullable|numeric',
            'cuppingResult' => 'nullable|string|max:255',
            'glossType' => 'nullable|string|max:50',
            'glossInput' => 'nullable|numeric',
            'glossResult' => 'nullable|string|max:255',
        ]);

        $today = Carbon::today()->format('Y-m-d');

        $testing = [
            [
                'test_name' => 'Cross Hatch Adhesion Test',
                'test_value' => $request->adhesionInput,
                'test_result' => $request->adhesionResult,
            ],
            [
                'test_name' => 'Pencil Hardness Test',
                'test_value' => $request->hardnessInput,
                'test_result' => $request->hardnessResult,
            ],
            [
                'test_name' => 'Impact Resistance Test',
                'test_value' => $request->impactInput,
                'test_result' => $request->impactResult,
            ],
            [
                'test_name' => 'Conical Mandrel Bend Test',
                'test_value' => $request->bendInput,
                'test_result' => $request->bendResult,
            ],
            [
                'test_name' => 'Cupping Test',
                'test_value' => $request->cuppingInput,
                'test_result' => $request->cuppingResult,
            ],
            [
                'test_name' => 'Gloss Measurement Test',
                'test_value' => $request->glossInput,
                'test_result' => $request->glossResult,
                'gloss_type' => $request->glossType,
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

        return redirect()->route('viewer.view-created-jobcards', $jobcard->order_id)
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

        return view('viewer.all-jobcards', compact('jobcards'));
    }

    public function allRejectedJobcardsView(Request $request)
    {
        $threeDaysAgo = Carbon::now()->subDays(3)->toDateString();

        $query = Jobcard::with('order.client')
            ->where('jobcard_status', 'pre-treatment')
            ->whereNotNull('pre_treatment_date')
            ->whereNull('powder_apply_date')
            ->whereDate('pre_treatment_date', '<=', $threeDaysAgo)
            ->orderBy('id', 'desc');

        // Optional filters
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

        return view('viewer.reject-jobcards', compact('jobcards'));
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

        return view('viewer.material-out', compact('jobcards'));
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

        return view('viewer.stock-manage', compact('paints'));
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
        return view('viewer.profile');
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::guard('viewer')->user();

        $user->name = $request->name;
        $user->email = $request->email;

        // Only update password if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
