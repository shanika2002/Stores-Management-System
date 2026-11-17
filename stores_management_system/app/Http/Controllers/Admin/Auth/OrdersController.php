<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Orders;
use App\Models\Stores;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all(); 
        $stores = Stores::all();
        $orders = Orders::with('supplier','stores')->get();
        return view('admin.orders.index', compact('orders'));

    }

    public function create()
    {
        $supplier = Supplier::all(); 
        $stores = Stores::all();

        return view('admin.orders.create', compact('supplier','stores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            //'order_id' => 'required|max:255|string',
            'order_name' => 'required|max:255|string',
            'order_date' => 'required|date',
            'status' => 'sometimes|in:Pending,Shipped,Delivered,Cancelled',
            'total_cost' => 'required|numeric|min:0',
            'expected_delivery_date' => 'required|date|after_or_equal:order_date',
            'supplier_id' => 'required|integer|exists:supplier,supplier_id',
            'store_id' => 'required|integer|exists:stores,store_id',
        ]);
        

        Orders::create([
            //'order_id' => $request -> order_id,
            'order_name' => $request -> order_name,
            'order_date' => $request -> order_date,
            'status' => in_array($request->status, ['Pending', 'Shipped', 'Delivered', 'Cancelled']) ? $request->status : 'Pending',
            'total_cost' => (float) $request->total_cost,
            'expected_delivery_date' => $request -> expected_delivery_date,
            'supplier_id' => $request -> supplier_id,
            'store_id' => $request -> store_id,
        ]);

        return redirect('admin/orders/create')->with('status','Order Created');

    }

   
    public function edit(int $order_id)
    {
    // Retrieve the subcategory to be edited
    $orders = Orders::findOrFail($order_id);

    if (!$orders) {
        return redirect()->back()->with('error', 'Order not found!');
    }

    // Retrieve all categories for the dropdown
    $supplier = Supplier::all(); 
    $stores = Stores::all();

    $orders->save();

    // Pass both $sub_category and $categories to the view
    return view('admin.orders.edit', compact('orders', 'supplier', 'stores'));
    }


    public function update(Request $request, int $order_id)
    {
        $request->validate([
            //'order_id' => 'required|max:255|string',
            'order_name' => 'required|max:255|string',
            'order_date' => 'required|date',
            'status' => 'sometimes|in:Pending,Shipped,Delivered,Cancelled',
            'total_cost' => 'required|numeric|min:0',
            'expected_delivery_date' => 'required|date|after_or_equal:order_date',
            'supplier_id' => 'required|integer|exists:supplier,supplier_id',
            'store_id' => 'required|integer|exists:stores,store_id',
        ]);

        Orders::findOrFail($order_id)->update([
            //'order_id' => $request -> order_id,
            'order_name' => $request -> order_name,
            'order_date' => $request -> order_date,
            'status' => in_array($request->status, ['Pending', 'Shipped', 'Delivered', 'Cancelled']) ? $request->status : 'Pending',
            'total_cost' => (float) $request->total_cost,
            'expected_delivery_date' => $request -> expected_delivery_date,
            'supplier_id' => $request -> supplier_id,
            'store_id' => $request -> store_id,
        ]);

        return redirect()->back()->with('status','Order Updated');

    }

   

    public function destroy(int $order_id)
    {
    try {
        $orders = Orders::findOrFail($order_id); // Find subcategory by ID
        $orders->delete(); // Delete subcategory
        return redirect()->back()->with('success', 'Order deleted successfully!');
    } catch (Exception $e) {
        // Log the error and return a failure message
        Log::error('Delete Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to delete order!');
    }
    }
}
