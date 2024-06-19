@extends('layouts.default')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .cart-container {
            max-width: 1200px;
            margin: 100px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
        }
        .cart-items {
            flex: 3;
        }
        .cart-summary {
            flex: 1;
            margin-left: 20px;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }
        .cart-item-details {
            flex-grow: 1;
        }
        .cart-item-details h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        .cart-item-details p {
            margin: 5px 0;
            color: #666;
        }
        .cart-item-price {
            font-size: 18px;
            font-weight: bold;
            color: #000;
        }
        .cart-item-stock {
            font-size: 14px;
            color: #888;
        }
        .cart-item-remove {
            margin-left: 20px;
        }
        .cart-item-remove form {
            display: inline;
        }
        .cart-item-remove button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .cart-item-remove button:hover {
            background-color: #ff1a1a;
        }
        .empty-cart {
            text-align: center;
            padding: 50px 0;
            font-size: 18px;
            color: #888;
        }
        .cart-summary h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .cart-summary p {
            font-size: 18px;
            margin: 10px 0;
        }
        .cart-summary button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
        }
        .cart-summary button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <div class="cart-items">
            @if ($cartItems->isEmpty())
                <div class="empty-cart">
                    Your cart is currently empty.
                </div>
            @else
                @foreach ($cartItems as $cartItem)
                    <div class="cart-item">
                        <img src="{{ asset('storage/'.$cartItem->product->image) }}" alt="{{ $cartItem->product->name }}">
                        <div class="cart-item-details">
                            <h3>{{ $cartItem->product->name }}</h3>
                            <p>{{ $cartItem->product->description }}</p>
                        </div>
                        <div class="cart-item-price">
                            ${{ $cartItem->product->price }}
                        </div>
                        <div class="cart-item-stock">
                            {{ $cartItem->product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </div>
                        <div class="cart-item-remove">
                            <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="cart-summary">
            <h3>Order Summary</h3>
            @if (!$cartItems->isEmpty())
                @php
                    $totalPrice = $cartItems->sum(function($cartItem) {
                        return $cartItem->product->price;
                    });
                @endphp
                <p>Total Price: ${{ $totalPrice }}</p>
                <form action="{{ route('order.create') }}" method="POST">
                    @csrf
                    <button type="submit">Checkout</button>
                </form>
            @endif
        </div>
    </div>
</body>
</html>
@stop
