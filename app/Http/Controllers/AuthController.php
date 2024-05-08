<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return view('auth.login', ['error' => 'Kullanıcı adı veya şifre yanlış']);
        }

        Auth::login($user);

        return redirect()->route('index');
        dd($request->all());
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->name('logout');
    }
}
