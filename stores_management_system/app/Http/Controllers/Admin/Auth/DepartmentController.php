<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Stores;
use App\Models\Admin; // Updated from Employee to Admin
use App\Models\Location;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $location = Location::all();
        $admins = Admin::all(); // Updated from Employee to Admin
        $stores = Stores::all();
        $department = Department::all();
        return view('admin.department.index', compact('department'));
    }

    public function create()
    {
        $location = Location::all();
        $admins = Admin::all(); // Updated from Employee to Admin
        $stores = Stores::all();
        return view('admin.department.create', compact('location', 'admins', 'stores')); // Updated variable name
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|max:255|string',
            'status' => 'sometimes',
            'location_id' => 'required|exists:location,location_id',
            'employee_id' => 'required|exists:admins,id', // Updated to reference admins table
            'store_id' => 'required|exists:stores,store_id',
        ]);

        Department::create([
            'department_name' => $request->department_name,
            'status' => $request->status == true ? 1 : 0,
            'location_id' => $request->location_id,
            'employee_id' => $request->employee_id, // Still named employee_id but references admins.id
            'store_id' => $request->store_id,
        ]);

        return redirect('admin/department/create')->with('status', 'Department Created');
    }

    public function edit(int $department_id)
    {
        $department = Department::findOrFail($department_id);
        if (!$department) {
            return redirect()->back()->with('error', 'Department not found!');
        }

        $location = Location::all();
        $admins = Admin::all(); // Updated from Employee to Admin
        $stores = Stores::all();

        return view('admin.department.edit', compact('department', 'location', 'admins', 'stores')); // Updated variable name
    }

    public function update(Request $request, int $department_id)
    {
        $request->validate([
            'department_name' => 'required|max:255|string',
            'status' => 'sometimes',
            'location_id' => 'required|exists:location,location_id',
            'employee_id' => 'required|exists:admins,id', // Updated to reference admins table
            'store_id' => 'required|exists:stores,store_id',
        ]);

        Department::findOrFail($department_id)->update([
            'department_name' => $request->department_name,
            'status' => $request->status == true ? 1 : 0,
            'location_id' => $request->location_id,
            'employee_id' => $request->employee_id, // Still named employee_id but references admins.id
            'store_id' => $request->store_id,
        ]);

        return redirect()->back()->with('status', 'Department Updated');
    }

    public function destroy(int $department_id)
    {
        try {
            $department = Department::findOrFail($department_id);
            $department->delete();
            return redirect()->back()->with('success', 'Department deleted successfully!');
        } catch (\Exception $e) { // Updated to catch \Exception
            \Log::error('Delete Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete department!');
        }
    }
}