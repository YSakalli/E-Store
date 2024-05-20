<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Iletisim;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\CartController;

Route::get('/', function () {return view('pages.home');})->name('index');

Route::get('/iletisim', function () { return view('iletisim');});

Route::post('/iletisim-sonuc', [Iletisim::class,'ekleme'])->name('iletisim-sonuc');

Route::get('/tshirt', function () {
    $products = Product::all();
    return view('pages.tshirt', ['products' => $products]);
})->name('tshirt');


Route::get('/sweatshirt', function () {return view('pages.sweatshirt');})->name('sweatshirt');

Route::get('/pant', function () {return view('pages.pant');})->name('pant');

Route::get('/backpack', function () {return view('pages.backpack');})->name('backpack');

Route::get('/cart', function () {return view('pages.cart');})->name('cart');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/login',[AuthController::class, 'index'])->name('login');

Route::post('login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('register', [RegisterController::class, 'ekleme']);

