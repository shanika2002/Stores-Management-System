<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Stores;
use App\Models\Admin; // Updated from Employee to Admin
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoreController extends Controller
{
    public function index()
    {
        $location = Location::all();
        $admins = Admin::all(); // Updated from Employee to Admin
        $stores = Stores::with('location', 'admin')->get(); // Updated relationship name
        return view('admin.stores.index', compact('stores'));
    }

    public function create()
    {
        $location = Location::all();
        $admins = Admin::all(); // Updated from Employee to Admin
        return view('admin.stores.create', compact('location', 'admins')); // Updated variable name
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'code' => 'required|max:255|string',
            'status' => 'sometimes',
            'location_id' => 'required|exists:location,location_id',
            'employee_id' => 'required|exists:admins,id', // Updated to reference admins table
        ]);

        Stores::create([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status == true ? 1 : 0,
            'location_id' => $request->location_id,
            'employee_id' => $request->employee_id, // Still named employee_id but references admins.id
        ]);

        return redirect('admin/stores/create')->with('status', 'Store Created');
    }

    public function edit(int $store_id)
    {
        $stores = Stores::findOrFail($store_id);
        if (!$stores) {
            return redirect()->back()->with('error', 'Store not found!');
        }

        $location = Location::all();
        $admins = Admin::all(); // Updated from Employee to Admin

        return view('admin.stores.edit', compact('stores', 'location', 'admins')); // Updated variable name
    }

    public function update(Request $request, int $store_id)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'code' => 'required|max:255|string',
            'status' => 'sometimes',
            'location_id' => 'required|exists:location,location_id',
            'employee_id' => 'required|exists:admins,id', // Updated to reference admins table
        ]);

        Stores::findOrFail($store_id)->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status == true ? 1 : 0,
            'location_id' => $request->location_id,
            'employee_id' => $request->employee_id, // Still named employee_id but references admins.id
        ]);

        return redirect()->back()->with('status', 'Store Updated');
    }

    public function destroy(int $store_id)
    {
        try {
            $stores = Stores::findOrFail($store_id);
            $stores->delete();
            return redirect()->back()->with('success', 'Store deleted successfully!');
        } catch (\Exception $e) {
            \Log::error('Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete store!');
        }
    }
}