<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.dashboard', compact('orders'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,completed,canceled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Статус заявки обновлен');
    }
}
