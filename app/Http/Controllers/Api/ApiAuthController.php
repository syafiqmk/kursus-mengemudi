<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    // Register
    public function register(Request $request) {
        $credentials = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $auth = User::create([
            'name' => ucwords($credentials['name']),
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
            'role' => 'student'
        ]);

        if($auth) {
            return response([
                'message' => 'Account created!',
                'auth' => $auth,
                'token' => $auth->createToken('kursus_mengemudi')->plainTextToken
            ], 200);
        } else {
            return response([
                'message' => 'Account fail to create!'
            ]);
        }
    }

    // Login
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        }

        $auth = User::where('email', $credentials['email'])->firstOrFail();

        if ($auth) {
            return response([
                'message' => 'You are logged in!',
                'auth' => $auth,
                'token' => $auth->createToken('kursus_mengemudi')->plainTextToken
            ]);
        } else {
            return response([
                'message' => 'Fail to log in!'
            ], 200);
        }
    }

    // Profile
    public function profile() {
        return response([
            'auth' => auth()->user()
        ], 200);
    }

    // Logout
    public function logout() {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'You are logged out!'
        ]);
    }
}
