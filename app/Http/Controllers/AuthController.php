<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Validasi data registrasi
    $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'contact_number' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Membuat user baru
    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'contact_number' => $request->contact_number,
        'password' => Hash::make($request->password),
    ]);

    // Redirect ke login setelah registrasi berhasil
    return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
}


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
