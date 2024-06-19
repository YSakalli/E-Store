<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cardItems = CartItem::All();
        $product = Product::All();

        return view('pages.cart', [
            'cartItems' => $cardItems,
            'products' => $product
    ]);
    }
    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $user = Auth::user();

        $cartId = $user->card_id;
        $cartItem = CartItem::where('cart_id', $cartId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('tshirt')->with('success', 'Product added to cart successfully!');
    }



}
