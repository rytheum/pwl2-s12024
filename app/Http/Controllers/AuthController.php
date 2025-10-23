<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // 🔹 Tampilkan halaman login
    public function loginForm()
    {
        return view('auth.login');
    }

    // 🔹 Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // 🔹 Halaman register
    public function registerForm()
    {
        return view('auth.register');
    }

    // 🔹 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|min:2|confirmed',
        ]);

        $userModel = new User();
        $user = $userModel->createUser($request->only(['name', 'email', 'password']));

        if (!$user) {
            return redirect()->route('register')
                ->with(['error' => 'Email yang Anda masukkan sudah terdaftar!']);
        }

        return redirect()->route('login')
            ->with(['success' => 'Register Berhasil! Akun berhasil dibuat.']);
    }

    // 🔹 Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
