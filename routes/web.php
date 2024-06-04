<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\InstrumentController;
use App\Http\Controllers\Seller\InstrumentImageController;
use App\Http\Controllers\Seller\SlideController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginGoogleController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\InstrumentController as BuyerInstrumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Buyer\OrderController;
use App\Http\Controllers\Buyer\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Seller\OrderController as SellerOrderController;
use App\Http\Controllers\Seller\PaymentController as SellerPaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'formLogin'])
    ->name('login')
    ->middleware('guest');
Route::post('/validation', [LoginController::class, 'validationUser'])->name('validation.user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'formRegister'])
    ->name('register')
    ->middleware('guest');
Route::post('/create/user', [RegisterController::class, 'store'])->name('register.user');

Route::group(['middleware' => ['role:admin|seller', 'auth'], 'prefix' => 'seller', 'as' => 'seller.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('slides', SlideController::class);
    Route::resource('instruments', InstrumentController::class);
    Route::resource('images', InstrumentImageController::class);
    Route::resource('orders', SellerOrderController::class);
    Route::put('payment/update/{id}', [SellerPaymentController::class, 'update'])->name('payment');
});

Route::resource('users', UserController::class)->middleware(['auth', 'role:admin']);

Route::resource('carts', CartController::class)->middleware('auth');
Route::group(['prefix' => '/', 'as' => '/.'], function () {
    Route::resource('instruments', BuyerInstrumentController::class);
});

Route::resource('profile', ProfileController::class)->middleware('auth');

Route::get('order', [OrderController::class, 'index'])->middleware('auth')->name('order');
Route::post('order/store', [OrderController::class, 'store'])->middleware('auth');
Route::get('order/detail/{id}', [OrderController::class, 'detail'])->middleware('auth');

Route::post('payment/store', [PaymentController::class, 'store'])->middleware('auth')->name('payment.store');

Route::get('/auth/google/redirect', [LoginGoogleController::class, 'googleRedirect'])->name('google.redirect');
Route::get('/auth/google/callback', [LoginGoogleController::class, 'googleCallback']);