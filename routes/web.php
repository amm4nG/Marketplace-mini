<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'formLogin'])->name('login')->middleware('guest');
Route::post('/validation', [LoginController::class, 'validationUser'])->name('validation.user');

Route::group(['middleware' => ['role:seller', 'auth']], function () {
    Route::get('/dashboard', function(){
        return 'hello world';
    })->name('dashboard');
});

Route::get('/register', [RegisterController::class, 'formRegister'])->name('register')->middleware('guest');
Route::post('/create/user', [RegisterController::class, 'store'])->name('register.user');
