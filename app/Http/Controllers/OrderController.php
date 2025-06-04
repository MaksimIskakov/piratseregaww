<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'datetime' => 'required|date',
            'weight' => 'required|numeric|min:0.1',
            'dimensions' => 'required|string',
            'from_address' => 'required|string',
            'to_address' => 'required|string',
            'cargo_type' => 'required|in:fragile,perishable,refrigerated,animals,liquid,furniture,garbage',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'datetime' => $request->datetime,
            'weight' => $request->weight,
            'dimensions' => $request->dimensions,
            'from_address' => $request->from_address,
            'to_address' => $request->to_address,
            'cargo_type' => $request->cargo_type,
            'needs_disposal' => $request->cargo_type === 'garbage',
        ]);

        return redirect()->route('orders.index')->with('success', 'Заявка успешно создана!');
    }
}
