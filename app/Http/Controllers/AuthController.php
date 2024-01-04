<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::claims([
            'email' => $request->email,
            'datetime' => \Carbon\Carbon::now()->toISOString(),
            'random' => Str::random(250)
        ])->attempt($credentials);
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }


        $user = Auth::user();

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token,
                'email' => $user->email,
                'datetime' => \Carbon\Carbon::now()->toISOString()
            ]
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out',
        ]);
    }
}
