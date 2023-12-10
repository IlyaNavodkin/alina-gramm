<?php

namespace App\Http\Controllers;

use App\Models\ContactsMessage;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;

class MessagesController extends Controller
{
    public function getAll(){
        $messages = Message::with('user', 'chat')->get();

        return view('admin-panel.messages.getAll', ['messages' => $messages]);
    }


    public function sendContactMessage(Request $request)
    {

        $content = $request->input('message');
        $contactId = $request->input('contact_id'); // изменено имя переменной
        $activeDialog = Contact::find($contactId)->load('userFrom', 'userTo', 'messages');

        $activeUser = Auth::user();

        if($content == null) {
            dd($request->all());

            $message = "Сообщение не может быть пустым";
            return redirect()->back()->with('error', $message);
        }

        $contactsMessage = new ContactsMessage();
        $contactsMessage->content = $content;
        $contactsMessage->contact_Id = $contactId;
        $contactsMessage->user_id = $activeUser->id;

        $contactsMessage->save();

        // return view('include.chats.conversation', compact('activeDialog'));
        return redirect()->back();
    }


    public function delete(Request $request)
    {
        $messageId = $request->input('messageId');
        $message = ContactsMessage::find($messageId);
        $message->delete();

        return redirect()->back();
    }
}
