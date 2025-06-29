<?php

namespace App\Http\Controllers;

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

        try {
            DB::connection()->getPdo();
            echo 'Database connection successful';
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        echo 'fim';
    }

    public function logout()
    {
        echo 'logout';
    }
}
