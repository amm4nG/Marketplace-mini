<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        function generateRandomPassword($length = 8)
        {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
            $charactersLength = strlen($characters);
            $randomPassword = '';

            for ($i = 0; $i < $length; $i++) {
                $randomPassword .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomPassword;
        }

        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->getId())->orWhere('email', $googleUser->getEmail())->first();
            DB::beginTransaction();
            if (!$user) {
                $newUser = new User();
                $newUser->google_id = $googleUser->getId();
                $emailParts = explode('@', $googleUser->getEmail());
                $newUser->username = $emailParts[0];
                $newUser->email = $googleUser->getEmail();
                $newUser->role = 'buyer';
                $newUser->password = Hash::make(generateRandomPassword());
                $newUser->email_verified_at = now();
                $newUser->save();

                Profile::create([
                    'user_id' => $newUser->id,
                    'name' => $googleUser->getName(),
                    'photo_profile' => $googleUser->user['picture']
                ]);

                DB::commit();

                Auth::login($newUser);
                return redirect()->intended('/');
            } else {
                Auth::login($user);
                return redirect()->intended('/');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()
                ->route('login')
                ->withErrors([
                    'message' => 'There was an error logging in with Google. Please try again',
                ]);
        }
    }
}
