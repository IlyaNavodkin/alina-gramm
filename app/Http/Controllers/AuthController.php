<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('users.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showRegistrationForm()
    {
        return view('users.singup');
    }

    public function register(Request $request)
    {
        $isValid = $request->validate([
            'email' => [
                'required',
                'min:4',
                'max:100',
                'unique:users,email'
            ],
            'phone' => [
                'required',
                'min:4',
                'max:20',
                'unique:users,phone'
            ],
            'login' => [
                'required',
                'min:4',
                'max:50',
                'unique:users,login'
            ],
            'password' => [
                'required',
                'min:6',
            ],
        ]);

        $user = new User();
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password =  Hash::make($request->input('password'));
        $user->login = $request->input('login');
        $user->banned = false;
        $user->roles='User';

        $user->save();

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('users.login');
    }
}
