<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginValidationRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function formLogin()
    {
        return view('auth.login');
    }

    public function validationUser(LoginValidationRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('dashboard');
            }
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'message' => 'Email atau password tidak valid',
        ]);
    }
}
