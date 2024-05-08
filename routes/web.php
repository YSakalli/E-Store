<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Iletisim;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {return view('pages.home');})->name('index');

Route::get('/iletisim', function () { return view('iletisim');});

Route::post('/iletisim-sonuc', [Iletisim::class,'ekleme'])->name('iletisim-sonuc');


Route::get('/bulb', function () { return view('pages.bulb');})->name('bulb');

Route::get('/wire', function () {return view('pages.wire');})->name('wire');

Route::get('/triplesocket', function () {return view('pages.triplesocket');})->name('triplesocket');

Route::get('/transformer', function () {return view('pages.transformer');})->name('transformer');

Route::get('/cart', function () {return view('cart');})->name('cart');

// Kullanıcı giriş sayfası
Route::get('/login',[AuthController::class, 'index'])->name('login');

Route::post('login', [AuthController::class, 'login']);

// Kullanıcı ekleme formu gösterme
Route::get('/register', [RegisterController::class, 'index'])->name('register');

// Kullanıcı ekleme işlemi
Route::post('register', [RegisterController::class, 'ekleme']);

