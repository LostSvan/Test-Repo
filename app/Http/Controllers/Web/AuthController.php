<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        if (Auth::check()) {
            return redirect()->route('tasks.index');
        }
        return view('auth.login');
    }
    public function register() {
        if (Auth::check()) {
            return redirect()->route('tasks.index');
        }
        return view('auth.register');
    }

    public function processLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('projects.index');
        }

        return back()->withErrors(['email' => 'Incorrect credentials']);
    }

    public function processRegister(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('projects.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
