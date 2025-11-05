<?php

namespace App\Http\Controllers;

use App\Models\Paint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('manager.dashboard');
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
                    ->orWhere('paint_unique_id', 'like', "%{$search}%");
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

    // Paint Management Routes (Manager Guard) =============================================================================================================>
}
