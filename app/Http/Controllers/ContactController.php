<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }
    public function create( Request $request)
    {
        $activeUser = Auth::user();
        $otherUserId = $request->input('userId');

        $otherUser = User::where('id', $otherUserId)->first();

        if (!$otherUser) {
            $message = "Пользователь с id $otherUserId не найден";
            return response()->json(['error' => $message], 404);
        }

        if ($otherUser->id == $activeUser->id) {
            $message = "Вы не можете добавить самого себя в свои контакты";
            return response()->json(['error' => $message], 400);
        }

        // $existContact = Contact::where([
        //     'user_id_from' => $userId,
        //     'user_id_to' => $user->id,
        // ])->first();

        // if ($existContact) {
        //     if($existContact->status == "accepted") {
        //         $message = "Вы уже добавили пользователя с логином $login в свои контакты";
        //         return redirect()->back()->with('error', $message);
        //     }

        //     $message = "Вы уже добавили пользователя с логином $login в свои контакты";
        //     return redirect()->back()->with('error', $message);
        // }

        $existingContact = Contact::where(function ($query) use ($activeUser, $otherUser) {
            $query->where('user_id_from', $activeUser->id)
                ->where('user_id_to', $otherUser->id);
        })->orWhere(function ($query) use ($activeUser, $otherUser) {
            $query->where('user_id_from', $otherUser->id)
                ->where('user_id_to', $activeUser->id);
        })->first();

        if ($existingContact) {
            $message = "Контакт уже существует между пользователями";
            return response()->json(['error' => $message], 400);
        }

        $contact = new Contact();

        $contact->user_id_from = $activeUser->id;
        $contact->user_id_to = $otherUser->id;
        $contact->blocked = 0;
        $contact->status = "pending";

        $contact->save();

        return response()->json(['message' => 'Friend request sent successfully']);
    }

    public function accept(Request $request)
    {
        $contactId = $request->input('contactId');

        $contact = Contact::where('id', $contactId)->with('userFrom', 'userTo')->first();

        if (!$contact) {
            return redirect()->back()->with('error', 'Контакт не найден');
        }

        $contact->status = "accepted";
        $contact->save();

        return redirect()->back()->with('success', 'Контакт добавлен');
    }

    public function delete(Request $request)
    {
        $contactId = $request->input('contactId');
        $contact = Contact::where('id', $contactId)->with('userFrom', 'userTo')->first();

        if (!$contact) {
            return redirect()->back()->with('error', 'Контакт не найден');
        }

        $contact->delete();

        return redirect()->back()->with('success', 'Контакт убран');
    }
    public function chat($contactId, $activeUserId){
        $activeUser = User::findOrFail($activeUserId);

        $contact = Contact::findOrFail($contactId)->load('userFrom', 'userTo');
        $contact->messages;

        $otherUser = "";
        if($contact->user_id_from == $activeUser->id) {
            $otherUser = $contact->userTo;
        } else {
            $otherUser = $contact->userFrom;
        }

        // return $contact;
        return view('contacts.chat', compact('contact', 'activeUser', "otherUser"));

    }
}
