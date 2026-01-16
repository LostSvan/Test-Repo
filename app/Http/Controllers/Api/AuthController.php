<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Incorrect login details'], 401);
        }

        $user = Auth::user();

        return response()->json(['token' => $user->createToken('token')->plainTextToken], 200);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'token' => $user->createToken('token')->plainTextToken
        ], 201);
    }

    public function logout()
    {
        \auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
