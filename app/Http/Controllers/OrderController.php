<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->is_admin) {
            $orders = Orders::with('orderItems.product')->get();
        } else {
            $orders = Orders::with('orderItems.product')->where('user_id', $user->id)->get();
        }

        return view('pages.orders', compact('orders'));
    }
    public function userOrders()
    {
        $user = auth()->user();
        $orders = $user->orders;

        return view('pages.user_orders', compact('orders'));
    }
    public function updateStatus(Request $request, $orderId)
    {
        $order = Orders::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Sipariş durumu güncellendi.');
    }
    public function cancelOrder($id)
    {
    $order = Orders::findOrFail($id);

    if ($order->status === 'pending') {
        $order->status = 'cancelled';
        $order->save();
        return redirect()->route('user.orders')->with('success', 'Sipariş başarıyla iptal edildi.');
    } else {
        return redirect()->route('user.orders')->with('error', 'Bu sipariş iptal edilemez.');
    }
    }
    public function create(Request $request)
    {

        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Sipariş verebilmek için giriş yapmış olmanız gerekir.');
        }

        // Kullanıcının sepetinin olup olmadığını kontrol et
        $cart = $user->cart;
        if (!$cart) {
            return back()->with('error', 'Sepetiniz boş. Sipariş vermeden önce ürün ekleyin.');
        }

        // Sepet öğelerinin olup olmadığını kontrol et
        $cartItems = $cart->cartItems;
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Sepetiniz boş. Sipariş vermeden önce ürün ekleyin.');
        }

        // Toplam fiyat hesaplama
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity; // Adet ile çarpımını unutmayalım
        });

        // Sipariş oluşturma
        $order = new Orders();
        $order->user_id = $user->id;
        $order->total_price = $totalPrice;
        $order->save();

        // Sepet öğelerini sipariş öğelerine dönüştürme
        foreach ($cartItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cartItem->product_id;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->price = $cartItem->product->price;
            $orderItem->save();
        }

        // Sepet öğelerini silme
        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }

        return redirect()->route('order.success')->with('success', 'Siparişiniz başarıyla oluşturuldu!');
    }
}
