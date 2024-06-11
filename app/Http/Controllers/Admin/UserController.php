<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        $dataTable = new UserDataTable(request()->get('role'));
        return $dataTable->render('admin.users.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username_new' => ['required', 'unique:users,username'],
                'email_new' => ['required', 'unique:users,email', 'email'],
                'password_new' => ['required'],
            ],
            [
                'username_new.required' => 'The username field is required.',
                'username_new.unique' => 'The username has already been taken.',
                'email_new.required' => 'The email field is required.',
                'email_new.unique' => 'The email has already been taken.',
                'email_new.email' => 'The email field must be a valid email address.',
                'password_new.required' => 'The password field is required.',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        DB::beginTransaction();
        try {
            $user = new User();
            $user->username = $request->username_new;
            $user->email = $request->email_new;
            $user->password = Hash::make($request->password_new);
            $user->role = 'seller';
            $user->save();

            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->save();

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Add new user successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'errors' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => ['required', 'unique:users,username,' . $id],
                'email' => ['required', 'unique:users,email,' . $id, 'email'],
                'password' => ['nullable'],
            ],
            [
                'username.required' => 'The username field is required.',
                'username.unique' => 'The username has already been taken.',
                'email.required' => 'The email field is required.',
                'email.unique' => 'The email has already been taken.',
                'email.email' => 'The email field must be a valid email address.',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $user = User::findOrFail($id);
            $user->username = $request->username;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'errors' => $th->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return back()->with([
                'message' => 'Deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                'message' => $th->getMessage()
            ]);
        }
    }
}
