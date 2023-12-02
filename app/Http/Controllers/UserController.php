<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chat;
use App\Models\Contact;
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

    public function getUserChats($id)
    {
        // Получаем активного пользователя с его чатами
        $activeUser = User::with('chats')->findOrFail($id);

        // $pendingContacts = Contact::where('user_id_to', $id)->where('status', 'pending')->with('userTo')->get();
        $commingContacts = Contact::where('user_id_from', $id)->where('status', 'pending')->with('userFrom')->get();
        // $acceptedContacts = Contact::where('status', 'accepted')->where('user_id_to', $id)
        // ->orWhere('user_id_from', $id)
        // ->with('userTo')
        // ->get();

        $acceptedContacts = Contact::where('status', 'accepted')
        ->where(function ($query) use ($id)
        {
            $query->where('user_id_to', $id)->orWhere('user_id_from', $id);
        })
        ->with('userTo')
        ->with('userFrom')
        ->get();

        $pendingContacts = Contact::where('status', 'pending')
        ->where('user_id_to', $id)->with('userTo')->get();

        // Получаем все чаты
        $allChats = Chat::all();

        // Коллекция с чатами, в которых пользователь не участвует
        $notUsedChats = $allChats->reject(function ($chat) use ($activeUser) {
            return $activeUser->chats->contains('id', $chat->id);
        });

        // return compact('activeUser', 'notUsedChats', 'pendingContacts', 'acceptedContacts', 'commingContacts');
        // Возвращаем представление с активным пользователем и чатами
        return view('user-chats', compact('activeUser', 'notUsedChats', 'pendingContacts', 'acceptedContacts', 'commingContacts'));

        // return $activeUser;
    }


    function filterList($list1, $list2) {
        $filtered = array_filter($list1, function ($item1) use ($list2) {
            // Проверяем, есть ли элемент с таким же Id во втором списке
            foreach ($list2 as $item2) {
                if ($item1->id === $item2->id) {
                    return false; // Элемент найден, не включаем его в результат
                }
            }
            return true; // Элемент не найден, включаем его в результат
        });

        return $filtered;
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



    public function getUserContacts(User $user)
    {
        $contacts = $user->contacts;
        return view('users.contacts', compact('user', 'contacts'));
    }
}
