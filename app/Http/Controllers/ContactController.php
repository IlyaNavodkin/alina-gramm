<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }
    public function addContact( Request $request, $userId)
    {
        $login = $request->input('login');

        if (!$login) {
            $message = "Логин не указан";
            return redirect()->back()->with('error', $message);
        }

        $user = User::where('login', $login)->first();

        if (!$user) {
            $message = "Пользователь с логином $login не найден, проверьте правильность ввода";
            return redirect()->back()->with('error', $message);
        }

        if ($user->id == $userId) {
            $message = "Вы не можете добавить самого себя в свои контакты";
            return redirect()->back()->with('error', $message);
        }

        $existContact = Contact::where([
            'user_id_from' => $userId,
            'user_id_to' => $user->id,
        ])->first();

        if ($existContact) {
            if($existContact->status == "accepted") {
                $message = "Вы уже добавили пользователя с логином $login в свои контакты";
                return redirect()->back()->with('error', $message);
            }

            $message = "Вы уже добавили пользователя с логином $login в свои контакты";
            return redirect()->back()->with('error', $message);
        }

        $contact = new Contact();

        $contact->user_id_from = $userId;
        $contact->user_id_to = $user->id;
        $contact->blocked = 0;
        $contact->status = "pending";

        $contact->save();

        return redirect()->back()->with('success', 'Запрос на контакт отправлен');
    }
    public function acceptContact($userIdFrom, $userIdTo)
    {
        $contact = Contact::where([
            'user_id_from' => $userIdFrom,
            'user_id_to' => $userIdTo,
        ])->first();

        if (!$contact) {
            return redirect()->back()->with('error', 'Контакт не найден');
        }

        $contact->status = "accepted";
        $contact->save();

        return redirect()->back()->with('success', 'Контакт добавлен');
    }

    public function deleteContact($userIdFrom, $userIdTo){
        $contact = Contact::where([
            'user_id_from' => $userIdFrom,
            'user_id_to' => $userIdTo,
        ])->first();

        if (!$contact) {
            return redirect()->back()->with('error', 'Контакт не найден');
        }

        $contact->delete();

        return redirect()->back()->with('success', 'Контакт убран');
    }
}
