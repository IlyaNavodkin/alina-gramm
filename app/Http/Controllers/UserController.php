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

    public function editUser($id)
    {
        $activeUser = User::find($id);
        $avatarPath = asset( $activeUser->avatar);

        return view('user-edit', compact('activeUser', 'avatarPath'));
    }

    public function edit(Request $request)
    {
        $isValid = $request->validate([
            'email' => [
                'required',
                'min:4',
                'max:100',
            ],
            'phone' => [
                'required',
                'min:4',
                'max:20',
            ],
            'login' => [
                'required',
                'min:4',
                'max:50',
            ],
        ]);

        $email = $request->input('email');
        $phone = $request->input('phone');
        $login = $request->input('login');
        $id = $request->input('id');

        // Проверка уникальности логина, email и телефона в базе данных
        $loginExists = User::where('login',  $login)
            ->where('id', '!=', $id)
            ->exists();

        $emailExists = User::where('email', $email)
            ->where('id', '!=',  $id)
            ->exists();

        $phoneExists = User::where('phone', $phone)
            ->where('id', '!=', $id)
            ->exists();

        // Если найден дубликат, вернуть ошибку
        if ($loginExists) {
            return back()->withErrors(['login' => 'Пользователь с таким логином уже существует.']);
        }

        if ($emailExists) {
            return back()->withErrors(['email' => 'Пользователь с таким email уже существует.']);
        }

        if ($phoneExists) {
            return back()->withErrors(['phone' => 'Пользователь с таким телефоном уже существует.']);
        }

        $user = User::find($id);

        if($email == $user->email && $phone == $user->phone && $login == $user->login) {
            return redirect()->back()->with('success', 'Вы не изменили данные пользователя');
        }

        $user->email = $email;
        $user->phone = $phone;
        $user->login = $login;

        $user->save();

        return redirect()->back()->with('success', 'Данные пользователя обновлены');
    }

    public function uploadUserAvatar(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $id = $request->input('id');

        $imageName = 'avatar'.$id.'.'.$image->extension();

        $relateAvatarFolderPath = 'media/users/avatars';
        $publicAvatarFolderPath = asset($relateAvatarFolderPath);

        $user = User::find($id);

        $user->avatar = $relateAvatarFolderPath. '/' .$imageName;
        $user->save();

        $image->move($relateAvatarFolderPath, $imageName);

        return back()->with('success', 'Аватар пользователя успешно загружен.');
    }

    public function getUserContacts(User $user)
    {
        $contacts = $user->contacts;
        return view('users.contacts', compact('user', 'contacts'));
    }
}
