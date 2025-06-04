<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order)
    {
        if ($order->status !== 'completed') {
            return back()->with('error', 'Отзыв можно оставить только для выполненного заказа');
        }

        $request->validate([
            'comment' => 'required|string|min:10',
            'rating' => 'required|integer|between:1,5',
        ]);

        Review::create([
            'order_id' => $order->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Отзыв успешно добавлен');
    }
}
