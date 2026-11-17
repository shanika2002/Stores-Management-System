<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Message;
use App\Models\Item;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showMessages()
    {
        // Fetch the count of unread messages for the logged-in admin user
        $unreadMessagesCount = Message::where('id', auth('admin')->id())->where('read', false)->count();

        // Fetch the total items count
        $totalItemsCount = Item::count();

        // Fetch the total cost of orders
        $totalCostOfOrders = Orders::sum('total_cost');

        // Fetch the total count of pending orders
        $totalPendingOrdersCount = Orders::where('status', 'pending')->count();

        // Fetch the total count of out-of-stock transactions
        $totalOutOfStockCount = StockTransaction::where('transaction_type', 'out')->count();

        // Pass the counts to the view
        return view('admin.dashboard', compact('unreadMessagesCount', 'totalItemsCount', 'totalCostOfOrders', 'totalPendingOrdersCount', 'totalOutOfStockCount'));
    }
}
