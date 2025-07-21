<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        $title='Daftar';
        return view('auth.register',compact('title'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $gudepRole = Role::where('name', 'Kwarcab')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $gudepRole->id,
            'region_id' => null,
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silakan login.');
    }

    public function showLoginForm()
    {
        $title='Masuk';
        return view('auth.login',compact('title'));
    }

    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        $request->session()->regenerate();

        $role = Auth::user()->role->name;

        if ($role === 'Kwarcab') {
            return redirect()->route('kwarcab.dashboard.index')->with('success', 'Login berhasil!');
        } elseif ($role === 'Kwarran') {
            return redirect()->route('kwarran.dashboard.index')->with('success', 'Login berhasil!');
        } elseif ($role === 'Gudep') {
            return redirect()->route('gudep.dashboard.index')->with('success', 'Login berhasil!');
        }

        Auth::logout();
        return back()->withErrors([
            'email' => 'Role pengguna tidak valid.',
        ])->withInput();
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->withInput()->with('error','Email atau Password Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
