<?php

namespace App\Http\Controllers;

use App\Models\ContactsMessage;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
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

        return  redirect()->back()->with('success', 'Контакт добавлен');
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
    public function chat($activeContactId = null){
        $activeUser = Auth::user();
        $activeUserId = $activeUser->id;

        $allAcceptedContacts = Contact::where(function($query) use ($activeUserId) {
            $query->where('user_id_to', $activeUserId)
                  ->orWhere('user_id_from', $activeUserId);
        })
        ->where('status', 'accepted')
        ->with('messages', 'userFrom', 'userTo')
        ->get();

        foreach ($allAcceptedContacts as $contact) {
            $messages = $contact->messages;
            $lastMessage = $messages->last();

            $contact->friend = $contact->user_id_from == $activeUserId ? $contact->userTo : $contact->userFrom;

            $newMessage = new ContactsMessage();
            $newMessage->content = 'Новое сообщение';

            $contact->lastMessage = $lastMessage;

        }

        $activeDialog = Contact::find($activeContactId);
        if($activeDialog){
            // dd($activeDialog);

            $activeDialog->load('userFrom', 'userTo', 'messages');

            if (!$activeDialog) {
                return response()->json(['error' => 'Contact not found'], 404);
            }

            if(Auth::user()->id != $activeDialog->userFrom->id){
                $friend = $activeDialog->userFrom;
            }
            if(Auth::user()->id != $activeDialog->userTo->id){
                $friend = $activeDialog->userTo;
            }

            $activeDialog->friend = $friend;

            // dd($activeDialog);
        }

        return view('users.chat', compact('allAcceptedContacts', 'activeUser', 'activeDialog'));
    }
}
