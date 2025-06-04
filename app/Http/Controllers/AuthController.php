<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|string|min:6|unique:users|regex:/^[а-яА-ЯёЁ]+$/u',
            'password' => ['required', 'confirmed', Password::min(6)],
            'full_name' => 'required|string|regex:/^[а-яА-ЯёЁ\s]+$/u',
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/',
            'email' => 'required|email',
        ]);

        $user = User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        Auth::login($user);

        return redirect()->route('orders.index');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('orders.index');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
