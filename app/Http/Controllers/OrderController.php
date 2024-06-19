<?php

// OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\User;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();

        // if (!$user) {
        //     return redirect()->route('login')->with('error', 'You must be logged in to place an order.');
        // }

        // if (!$user->cart) {
        //     return back()->with('error', 'You must have a cart to place an order.');
        // }

        $cart = $user->cart;
        $cartItems = $cart->cartItems;

        // if ($cartItems->isEmpty()) {
        //     return back()->with('error', 'Your cart is empty. Add some items before placing an order.');
        // }

        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price;
        });

        $order = new Orders();
        $order->user_id = $user->id;
        $order->total_price = $totalPrice;
        $order->save();

        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->quantity = 1;
            $orderItem->price = $cartItem->product->price;
            $orderItem->save();
        }

        $cartItems->delete();

        return redirect()->route('order.success')->with('success', 'Order placed successfully!');
    }
}
