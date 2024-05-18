<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegisterUserRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function formRegister()
    {
        return view('auth.register');
    }

    public function store(StoreRegisterUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Profile::create([
                'user_id' => $user->id,
            ]);
            DB::commit();
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('/');
            }
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return 'failed';
        }
    }
}
