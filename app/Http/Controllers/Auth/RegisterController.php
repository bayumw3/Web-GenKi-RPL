<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Pastikan Auth di-import

class RegisterController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Menangani proses pendaftaran
    public function register(Request $request)
{
    $validatedData = $request->validate([
        'email' => 'required|email|unique:users,email',
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Create a new user
    $user = User::create([
        'email' => $validatedData['email'],
        'name' => $validatedData['name'],
        'phone_number' => $validatedData['phone_number'],
        'password' => bcrypt($validatedData['password']),
    ]);

    // Log the user in
    Auth::login($user);

    return redirect()->route('home'); // or wherever you want to redirect after successful registration
}


    public function checkEmail(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();

        if ($emailExists) {
            return response()->json(['status' => 'error', 'message' => 'Email sudah terdaftar.'], 400);
        }

        return response()->json(['status' => 'success', 'message' => 'Email tersedia.']);
    }

}

