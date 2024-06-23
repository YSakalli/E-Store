<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Iletisim;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {return view('pages.home');})->name('index');

Route::get('/tshirt', [ProductController::class, 'index'])->name('tshirt');


Route::get('/sweatshirt', function () {return view('pages.sweatshirt');})->name('sweatshirt');

Route::get('/success', function () {return view('pages.success');})->name('order.success');


Route::get('/pant', function () {return view('pages.pant');})->name('pant');

Route::get('/backpack', function () {return view('pages.backpack');})->name('backpack');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('productstore', [ProductController::class, 'store'])->name('products.store');

Route::get('/addproduct', function () {
    $controller = new ProductController();
    $data = $controller->addProductView();
    return view('pages.addproduct', $data);
})->name('addproduct');


Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::post('/order', [OrderController::class, 'create'])->name('order.create');


Route::get('/login',[AuthController::class, 'index'])->name('login');

Route::post('login', [AuthController::class, 'login']);

Route::post('logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('register', [RegisterController::class, 'ekleme']);


Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [OrderController::class, 'userOrders'])->name('user.orders');
    Route::post('/order/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');


Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
