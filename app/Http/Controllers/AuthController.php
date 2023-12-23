<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('users.login');
    }

    public function showRegistrationForm()
    {
        return view('users.singup');
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

        $message = "Пользователь с такими данными не зарегистрирован";
        return redirect()->back()->withErrors(['warning' => $message]);
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        $validator->messages()->add('email.required', 'Поле "Email" обязательно для заполнения.');
        $validator->messages()->add('email.min', 'Минимальная длина поля "Email" - :min символа.');
        $validator->messages()->add('email.max', 'Максимальная длина поля "Email" - :max символов.');
        $validator->messages()->add('email.unique', 'Пользователь с таким email уже существует.');

        $validator->messages()->add('phone.required', 'Поле "Телефон" обязательно для заполнения.');
        $validator->messages()->add('phone.min', 'Минимальная длина поля "Телефон" - :min символа.');
        $validator->messages()->add('phone.max', 'Максимальная длина поля "Телефон" - :max символов.');
        $validator->messages()->add('phone.unique', 'Пользователь с таким телефоном уже существует.');

        $validator->messages()->add('login.required', 'Поле "Логин" обязательно для заполнения.');
        $validator->messages()->add('login.min', 'Минимальная длина поля "Логин" - :min символа.');
        $validator->messages()->add('login.max', 'Максимальная длина поля "Логин" - :max символов.');
        $validator->messages()->add('login.unique', 'Пользователь с таким логином уже существует.');

        $validator->messages()->add('password.required', 'Поле "Пароль" обязательно для заполнения.');
        $validator->messages()->add('password.min', 'Минимальная длина пароля - :min символов.');

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

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
