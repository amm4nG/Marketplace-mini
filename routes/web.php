<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Seller\CategoryController;
use App\Http\Controllers\Seller\DashboardController;
use App\Http\Controllers\Seller\InstrumentController;
use App\Http\Controllers\Seller\InstrumentImageController;
use App\Http\Controllers\Seller\SlideController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Buyer\CartController;
use App\Http\Controllers\Buyer\InstrumentController as BuyerInstrumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Buyer\OrderController;
use App\Http\Controllers\Buyer\PaymentController;
use App\Http\Controllers\ProfileController;
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
});
Route::resource('users', UserController::class)->middleware(['auth', 'role:admin']);

Route::resource('carts', CartController::class)->middleware('auth');
Route::group(['prefix' => '/', 'as' => '/.'], function () {
    Route::resource('instruments', BuyerInstrumentController::class);
});

Route::resource('profile', ProfileController::class)->middleware('auth');

Route::get('orders', [OrderController::class, 'index'])->middleware('auth')->name('orders');
Route::post('order/store', [OrderController::class, 'store'])->middleware('auth');

Route::post('payment/store', [PaymentController::class, 'store'])->middleware('auth')->name('payment.store');