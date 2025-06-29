<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // Validate the request
        $request->validate(
            [
                'text_username' => 'required|string|email',
                'text_password' => 'required|string|min:6|max:16',
            ],
            [
                'text_username.required' => 'Username is required',
                'text_username.email' => 'Username must be a valid email address',
                'text_password.required' => 'Password is required',
                'text_password.min' => 'Password must be at least :min characters',
                'text_password.max' => 'Password cannot exceed :max characters',
            ]
        );

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('username', $username)->where('deleted_at', null)->first();
        if (!$user) {
            return redirect()->back()->withInput()->with(['loginError' => 'Username or password is incorrect']);
        }

        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with(['loginError' => 'Username or password is incorrect']);
        }

        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        session(['user' => ['id' => $user->id, 'username' => $user->username]]);

        return redirect()->to('/');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->to('/login');
    }

    public function register()
    {
        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        // Validate the request
        $request->validate(
            [
                'text_username' => 'required|string|email|unique:users,username',
                'text_password' => 'required|string|min:6|max:16',
            ],
            [
                'text_username.required' => 'Username is required',
                'text_username.email' => 'Username must be a valid email address',
                'text_username.unique' => 'Username already exists',
                'text_password.required' => 'Password is required',
                'text_password.min' => 'Password must be at least :min characters',
                'text_password.max' => 'Password cannot exceed :max characters',
            ]
        );

        $username = $request->input('text_username');
        $password = password_hash($request->input('text_password'), PASSWORD_DEFAULT);

        DB::table('users')->insert([
            'username' => $username,
            'password' => $password,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/login');
    }
}
