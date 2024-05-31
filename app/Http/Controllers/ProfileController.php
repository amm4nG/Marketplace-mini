<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => ['required', 'unique:users,username,' . $id],
            'email' => ['required', 'unique:users,email,' . $id],
            'name' => 'required',
            'no_handphone' => ['required', 'unique:profiles,no_handphone,' . $id],
            'gender' => 'required',
            'address' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        $user->profile->name = $request->name;
        $user->profile->no_handphone = $request->no_handphone;
        $user->profile->gender = $request->gender;
        $user->profile->address = $request->address;
        $user->profile->update();
        return back()->with([
            'message' => 'Updated profile successful'
        ]);
    }
}
