<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chat;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard($activeDialogId = null)
    {
        $activeDialog = null;

        $activeUser = Auth::user();
        $id = $activeUser->id;

        $commingContacts = Contact::where('user_id_from', $id)->where('status', 'pending')->with('userFrom')->get();

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


        foreach ($acceptedContacts as $contact) {

            if ($contact->user_id_from == $id) {
                $contact->friend = $contact->userTo;
            } else {
                $contact->friend = $contact->userFrom;
            }
        }

        foreach ($pendingContacts as $contact) {

            if ($contact->user_id_from == $id) {
                $contact->friend = $contact->userTo;
            } else {
                $contact->friend = $contact->userFrom;
            }
        }

        foreach ($commingContacts as $contact) {

            if ($contact->user_id_from == $id) {
                $contact->friend = $contact->userTo;
            } else {
                $contact->friend = $contact->userFrom;
            }
        }

        $avatarPath = asset( $activeUser->avatar);
        $findestUsers = [];

        return view('users.my-contacts', compact('activeUser', 'pendingContacts',
        'acceptedContacts', 'commingContacts', 'avatarPath', 'activeDialog',  'findestUsers'));
    }


    public function findByLogin(Request $request)
    {
        $activeUser = Auth::user();
        $login = $request->input('login');
        $id = $activeUser->id;

        $acceptedContacts = Contact::where('status', 'accepted')
            ->where(function ($query) use ($id) {
                $query->where('user_id_to', $id)->orWhere('user_id_from', $id);
            })
            ->with('userTo')
            ->with('userFrom')
            ->get();

        // Получаем id всех пользователей, связанных с активным пользователем через контакты
        $relatedUserIds = [];
        foreach ($acceptedContacts as $contact) {
            $relatedUserIds[] = $contact->user_id_from;
            $relatedUserIds[] = $contact->user_id_to;
        }

        // Убираем дубликаты id пользователей
        $relatedUserIds = array_unique($relatedUserIds);

        // Находим всех пользователей, у которых логин подходит под условие и которых еще нет в контактах
        $unknownUsers = User::where('login', 'LIKE', "%$login%")
            ->whereNotIn('id', $relatedUserIds)
            ->get();

        return view('include.contacts.find-users.find-user-result', ['users' => $unknownUsers]);
    }

    public function delete (){
        $userId = Auth::user()->id;

        $user = User::find($userId);
        $user->delete();

        return redirect()->back()->with('success', 'Пользователь удален');
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

    public function profile()
    {
        $activeUser = Auth::user();
        $avatarPath = asset( $activeUser->avatar);

        return view('users.profile', compact('activeUser', 'avatarPath'));
    }

    public function uploadAvatar(Request $request)
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
}
