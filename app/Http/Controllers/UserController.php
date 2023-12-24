<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chat;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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
        Log::info('Whatever you need to send to your log');
        $activeUser = Auth::user();
        $login = $request->input('login');
        $id = $activeUser->id;

        $acceptedContacts = Contact::where('status', 'accepted')
            ->where(
                function ($query) use ($id) {
                $query->where('user_id_to', $id)->orWhere('user_id_from', $id);
            })
            ->with('userTo')
            ->with('userFrom')
            ->get();

        $ignoredIds = [];

        foreach ($acceptedContacts as $contact) {
            $ignoredIds[] = $contact->user_id_from;
            $ignoredIds[] = $contact->user_id_to;
        }

        $ignoredIds = array_unique($ignoredIds);

        $unknownUsers = User::where('login', 'LIKE', "%$login%")
            ->whereNotIn('id', $ignoredIds)
            ->get();

        return view('include.contacts.find-users.find-user-result', ['users' => $unknownUsers]);
        // return response()->json($unknownUsers);
    }

    public function delete (){
        $userId = Auth::user()->id;

        $user = User::find($userId);
        $user->delete();

        return redirect()->back()->with('success', 'Пользователь удален');
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'min:4', 'max:100'],
            'phone' => ['required', 'min:4', 'max:20'],
            'login' => ['required', 'min:4', 'max:50'],
        ]);

        // Настройка сообщений об ошибках на русском языке
        $validator->messages()->add('email.required', 'Поле "Email" обязательно для заполнения.');
        $validator->messages()->add('email.min', 'Минимальная длина поля "Email" - :min символа.');
        $validator->messages()->add('email.max', 'Максимальная длина поля "Email" - :max символов.');

        $validator->messages()->add('phone.required', 'Поле "Телефон" обязательно для заполнения.');
        $validator->messages()->add('phone.min', 'Минимальная длина поля "Телефон" - :min символа.');
        $validator->messages()->add('phone.max', 'Максимальная длина поля "Телефон" - :max символов.');

        $validator->messages()->add('login.required', 'Поле "Логин" обязательно для заполнения.');
        $validator->messages()->add('login.min', 'Минимальная длина поля "Логин" - :min символа.');
        $validator->messages()->add('login.max', 'Максимальная длина поля "Логин" - :max символов.');

        // Если валидация не проходит
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }


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
