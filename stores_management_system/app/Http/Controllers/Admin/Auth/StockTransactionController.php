<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Item;
use App\Models\Stores;
use App\Models\Admin; // Updated from Employee to Admin
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Http\Controllers\Controller;

class StockTransactionController extends Controller
{
    public function index()
    {
        $stock_transactions = StockTransaction::with('item', 'fromStore', 'toStore', 'admin', 'manager') // Updated relationship names
            ->get()
            ->groupBy('transaction_reference');
        
        return view('admin.stock.index', compact('stock_transactions'));
    }

    public function create()
    {
        $stores = Stores::all();
        $items = Item::all();
        $admins = Admin::all(); // Updated from Employee to Admin
        $managers = Admin::where('role', 'Manager')->get(); // Updated from Employee to Admin

        return view('admin.stock.create', compact('stores', 'items', 'admins', 'managers')); // Updated variable name
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:item,item_id',
            'items.*.quantity' => 'required|integer|min:1',
            'transaction_type' => 'required|in:IN,OUT,TRANSFER',
            'to_store_id' => 'required|exists:stores,store_id',
            'from_store_id' => 'nullable|exists:stores,store_id|different:to_store_id',
            'transaction_date' => 'required|date',
            'employee_id' => 'required|exists:admins,id', // Updated to reference admins table
            'manager_id' => 'nullable|exists:admins,id', // Updated to reference admins table
            'transaction_reference' => 'required|string|max:255|unique:stock_transactions,transaction_reference',
        ]);

        $transactionReference = $request->transaction_reference;

        foreach ($request->items as $itemData) {
            $transaction = StockTransaction::create([
                'transaction_reference' => $transactionReference,
                'transaction_type' => $request->transaction_type,
                'quantity' => $itemData['quantity'],
                'transaction_date' => $request->transaction_date,
                'item_id' => $itemData['item_id'],
                'from_store_id' => $request->transaction_type === 'TRANSFER' ? $request->from_store_id : null,
                'to_store_id' => $request->to_store_id,
                'employee_id' => $request->employee_id, // References admins.id
                'manager_id' => $request->manager_id, // References admins.id
            ]);

            $item = Item::findOrFail($itemData['item_id']);
            if ($request->transaction_type === 'IN') {
                $item->stock_quantity += $itemData['quantity'];
            } elseif ($request->transaction_type === 'OUT') {
                $item->stock_quantity -= $itemData['quantity'];
            } elseif ($request->transaction_type === 'TRANSFER') {
                $fromStoreItem = Item::where('item_id', $itemData['item_id'])->first();
                $fromStoreItem->stock_quantity -= $itemData['quantity'];
                $fromStoreItem->save();
                $item->stock_quantity += $itemData['quantity'];
            }
            $item->save();
        }

        return redirect()->route('admin.stock.index')->with('status', 'Stock transaction added successfully.');
    }

    public function edit($transaction_reference)
    {
        $stock_transactions = StockTransaction::where('transaction_reference', $transaction_reference)
            ->with('item', 'fromStore', 'toStore', 'admin', 'manager') // Updated relationship names
            ->get();
        
        if ($stock_transactions->isEmpty()) {
            return redirect()->route('admin.stock.index')->with('error', 'Transaction not found.');
        }

        $stores = Stores::all();
        $items = Item::all();
        $admins = Admin::all(); // Updated from Employee to Admin
        $managers = Admin::where('role', 'Manager')->get(); // Updated from Employee to Admin

        return view('admin.stock.edit', compact('stock_transactions', 'stores', 'items', 'admins', 'managers')); // Updated variable name
    }

    public function update(Request $request, $transaction_reference)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:item,item_id',
            'items.*.quantity' => 'required|integer|min:1',
            'transaction_type' => 'required|in:IN,OUT,TRANSFER',
            'to_store_id' => 'required|exists:stores,store_id',
            'from_store_id' => 'nullable|exists:stores,store_id|different:to_store_id',
            'transaction_date' => 'required|date',
            'employee_id' => 'required|exists:admins,id', // Updated to reference admins table
            'manager_id' => 'nullable|exists:admins,id', // Updated to reference admins table
            'transaction_reference' => 'required|string|max:255|unique:stock_transactions,transaction_reference,' . $transaction_reference . ',transaction_reference',
        ]);

        $oldTransactions = StockTransaction::where('transaction_reference', $transaction_reference)->get();
        if ($oldTransactions->isEmpty()) {
            return redirect()->route('admin.stock.index')->with('error', 'Transaction not found.');
        }

        foreach ($oldTransactions as $transaction) {
            $item = Item::findOrFail($transaction->item_id);
            if ($transaction->transaction_type === 'IN') {
                $item->stock_quantity -= $transaction->quantity;
            } elseif ($transaction->transaction_type === 'OUT') {
                $item->stock_quantity += $transaction->quantity;
            } elseif ($transaction->transaction_type === 'TRANSFER') {
                $fromStoreItem = Item::where('item_id', $transaction->item_id)->first();
                $fromStoreItem->stock_quantity += $transaction->quantity;
                $fromStoreItem->save();
                $item->stock_quantity -= $transaction->quantity;
            }
            $item->save();
            $transaction->delete();
        }

        foreach ($request->items as $itemData) {
            $transaction = StockTransaction::create([
                'transaction_reference' => $request->transaction_reference,
                'transaction_type' => $request->transaction_type,
                'quantity' => $itemData['quantity'],
                'transaction_date' => $request->transaction_date,
                'item_id' => $itemData['item_id'],
                'from_store_id' => $request->transaction_type === 'TRANSFER' ? $request->from_store_id : null,
                'to_store_id' => $request->to_store_id,
                'employee_id' => $request->employee_id, // References admins.id
                'manager_id' => $request->manager_id, // References admins.id
            ]);

            $item = Item::findOrFail($itemData['item_id']);
            if ($request->transaction_type === 'IN') {
                $item->stock_quantity += $itemData['quantity'];
            } elseif ($request->transaction_type === 'OUT') {
                $item->stock_quantity -= $itemData['quantity'];
            } elseif ($request->transaction_type === 'TRANSFER') {
                $fromStoreItem = Item::where('item_id', $itemData['item_id'])->first();
                $fromStoreItem->stock_quantity -= $itemData['quantity'];
                $fromStoreItem->save();
                $item->stock_quantity += $itemData['quantity'];
            }
            $item->save();
        }

        return redirect()->route('admin.stock.index')->with('status', 'Transaction updated successfully.');
    }

    public function destroy($transaction_reference)
    {
        $transactions = StockTransaction::where('transaction_reference', $transaction_reference)->get();

        if ($transactions->isEmpty()) {
            return redirect()->route('admin.stock.index')->with('error', 'Transaction not found.');
        }

        foreach ($transactions as $transaction) {
            $item = Item::findOrFail($transaction->item_id);
            if ($transaction->transaction_type === 'IN') {
                $item->stock_quantity -= $transaction->quantity;
            } elseif ($transaction->transaction_type === 'OUT') {
                $item->stock_quantity += $transaction->quantity;
            } elseif ($transaction->transaction_type === 'TRANSFER') {
                $fromStoreItem = Item::where('item_id', $transaction->item_id)->first();
                $fromStoreItem->stock_quantity += $transaction->quantity;
                $fromStoreItem->save();
                $item->stock_quantity -= $transaction->quantity;
            }
            $item->save();
            $transaction->delete();
        }

        return redirect()->route('admin.stock.index')->with('success', 'Transaction deleted successfully!');
    }

    public function receipt($transaction_reference)
    {
        $stock_transactions = StockTransaction::where('transaction_reference', $transaction_reference)
            ->with('item', 'fromStore', 'toStore', 'admin', 'manager') // Updated relationship names
            ->get();

        if ($stock_transactions->isEmpty()) {
            return redirect()->route('admin.stock.index')->with('error', 'Transaction not found.');
        }

        $pdf = PDF::loadView('admin.stock.receipt', compact('stock_transactions'));
        return $pdf->download('Stock_Receipt_' . $transaction_reference . '.pdf');
    }
}