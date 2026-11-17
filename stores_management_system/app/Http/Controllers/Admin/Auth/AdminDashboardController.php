<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Item;
use App\Models\Orders;
use App\Models\Stores;
use App\Models\Location;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\StockTransaction;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        // $location = Location::all();
        // $stores = Stores::all();
        // $department = Department::all();
        // $item = Item::all();
        // $stock_transactions = StockTransaction::all();

        // return view('admin.dashboard', compact('location', 'stores', 'department', 'item', 'stock_transactions'));

        // Calculate the total number of items (example from a `FoodItem` model)
    $totalItemsCount = Item::sum('stock_quantity'); // Replace 'FoodItem' with your actual model

    $totalCost = Orders::sum('total_cost');

    // Calculate Total Orders
    $totalOrders = Orders::count();

    // Count Pending Orders
    $pendingOrders = Orders::where('status', 'pending')->count();

    // Calculate Pending Orders Percentage (avoid division by zero)
    $pendingPercentage = ($totalOrders > 0) ? ($pendingOrders / $totalOrders) * 100 : 0;

    // Count Total Out of Transaction (failed or canceled orders)
    $totalOutOfTransaction = Orders::where('status', 'failed')
                                 ->orWhere('status', 'canceled')
                                 ->count();

    // Count Total Transactions
$totalTransactions = StockTransaction::count();

// Count Out of Stock Transactions (distinct item_id for transaction_type = 'OUT')
$outOfStockTransactions = StockTransaction::where('transaction_type', 'OUT')->distinct('item_id')->count('item_id');


// Get total cost of orders per month for the current year
$monthlyTotalCost = Orders::selectRaw('SUM(total_cost) as total_cost, MONTH(created_at) as month, YEAR(created_at) as year')
    ->groupBy('year', 'month')
    ->orderBy('year', 'asc')  // Sorting by year
    ->orderBy('month', 'asc') // Sorting by month
    ->get();

// Prepare the chart data
$chartData = $monthlyTotalCost->map(function ($item) {
    return [
        'month' => $item->month,
        'year' => $item->year,
        'total_cost' => $item->total_cost,
    ];
});

 // Count Pending Orders
 $pendingOrders = Orders::where('status', 'Pending')->count();
 $shippedOrders = Orders::where('status', 'Shipped')->count();
 $deliveredOrders = Orders::where('status', 'Delivered')->count();
 $cancelledOrders = Orders::where('status', 'Cancelled')->count();





    // Pass the calculated value to the view
    return view('dashboard', compact('totalItemsCount','totalCost', 'totalOrders', 'pendingOrders', 'pendingPercentage', 'totalOutOfTransaction','totalTransactions', 'outOfStockTransactions', 'monthlyTotalCost', 'chartData', 'pendingOrders', 'shippedOrders', 'deliveredOrders', 'cancelledOrders'));

    }
}
