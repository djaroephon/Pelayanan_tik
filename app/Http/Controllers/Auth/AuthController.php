<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('name', $credentials['name'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);

            return match ($user->role) {
                'admin', 'operator' => redirect()->route('admin.dashboard'),
                'teknisi' => redirect()->route('teknisi.index'),
                default => redirect()->route('landing'),
            };
        }

        return back()->with('error', 'Nama atau password salah.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('landing');
    }
}
