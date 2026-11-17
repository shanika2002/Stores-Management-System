<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::get();
        return view('admin.supplier.index',compact('supplier'));
    }

    public function create()
    {
        return view('admin.supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            //'supplier_id' => 'required|max:255|string',
            'name' => 'required|max:255|string',
            'contact_name' => 'required|max:255|string',
            'email' => 'required|max:255|email',
            'address' => 'required|max:255|string',
            'phone' => 'required|max:255|string'
        ]);
        

        Supplier::create([
            //'supplier_id' => $request -> supplier_id,
            'name' => $request -> name,
            'contact_name' => $request -> contact_name,
            'email' => $request -> email,
            'address' => $request -> address,
            'phone' => $request -> phone
        ]);

        return redirect('admin/supplier/create')->with('status','Supplier Created');
    }

    public function edit(int $supplier_id)
    {
         $supplier = Supplier::findOrFail($supplier_id);
         return view('admin.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, int $supplier_id)
    {
        $request->validate([
            //'supplier_id' => 'required|max:255|string',
            'name' => 'required|max:255|string',
            'contact_name' => 'required|max:255|string',
            'email' => 'required|max:255|email',
            'address' => 'required|max:255|string',
            'phone' => 'required|max:255|string'
        ]);
        

        Supplier::findOrFail($supplier_id)->update([
            //'supplier_id' => $request -> supplier_id,
            'name' => $request -> name,
            'contact_name' => $request -> contact_name,
            'email' => $request -> email,
            'address' => $request -> address,
            'phone' => $request -> phone
        ]);

        return redirect('admin/supplier')->with('status','Supplier Updated');
  
    }

    public function destroy(int $supplier_id)
    {
        $supplier = Supplier::findOrFail($supplier_id);
        $supplier->delete();

        return redirect()->back()->with('status','Supplier Deleted');

    }
}
