<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Iletisim;
Route::get('/', function () {return view('pages.home');})->name('index');
Route::get('/iletisim', function () {
    return view('iletisim');
});
Route::post('/iletisim-sonuc', [Iletisim::class,'ekleme'])->name('iletisim-sonuc');


Route::get('/bulb', function () { return view('pages.bulb');})->name('bulb');

Route::get('/wire', function () {return view('pages.wire');})->name('wire');

Route::get('/triplesocket', function () {return view('pages.triplesocket');})->name('triplesocket');

Route::get('/transformer', function () {return view('pages.transformer');})->name('transformer');


Route::get('/cart', function () {return view('cart');})->name('cart');

Route::get('/login', function () {return view('login');})->name('login');

