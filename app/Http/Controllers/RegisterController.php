<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function ekleme(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Kullanıcı için bir kart oluştur ve kart ID'sini kullanıcıya ata
        $cart = Cart::create(['user_id' => $user->id]);
        $user->card_id = $cart->id;
        $user->save();

        // Kullanıcıyı otomatik olarak oturum aç
        Auth::login($user);

        return redirect('/')->with('success', 'Registration successful! You are now logged in.');
    }
}
