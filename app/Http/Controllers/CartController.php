<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Sepet ID'sini belirlemek için oturum veya kullanıcı ID'sini kullanabilirsiniz
        $cartId = session()->get('cart_id', 1);

        // Mevcut CartItem'ı kontrol edin
        $cartItem = CartItem::where('cart_id', $cartId)->where('product_id', $productId)->first();

        if ($cartItem) {
            // Mevcut CartItem güncellenir
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Yeni CartItem oluşturulur
            CartItem::create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('tshirt')->with('success', 'Product added to cart successfully!');
    }
}
