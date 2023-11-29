<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MyClass {
    public $name1;
    public $booleanProperty;
}
class UserController extends Controller
{
    public function users(){
        $users = new User();

        return view('users', ['users' => $users->all()]);
    }

    public function createNewUser(){
        return view('create-new-user');
    }

    public function delete($id)
    {
        $userForDelete=User::query()->where('id', $id)->delete();
        return redirect('/users');
    }

    public function create(Request $request)
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
        $user->password = $request->input('password');
        $user->login = $request->input('login');
        $user->banned = false;
        $user->roles='User';

        $user->save();

        return redirect('/users');
    }

    public function getUserChats(User $user)
    {
        $chats = $user->chats;
        return view('users.chats', compact('user', 'chats'));
    }

    public function getUserContacts(User $user)
    {
        $contacts = $user->contacts;
        return view('users.contacts', compact('user', 'contacts'));
    }
}
