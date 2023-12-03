<?php

namespace App\Http\Controllers;

use App\Models\ContactsMessage;
use Illuminate\Http\Request;
use App\Models\Message;

class MessagesController extends Controller
{
    public function getAll(){
        $messages = Message::with('user', 'chat')->get();

        return view('admin-panel.messages.getAll', ['messages' => $messages]);
    }

    public function send(Request $request, $chatId, $userId)
    {
    // Ваш код для сохранения сообщения в базе данных

        $message = new Message();
        $message->content = $request->input('message');
        $message->chat_id = $chatId;
        // Добавьте user_id, если у вас есть отношение "один ко многим" с таблицей пользователей
        $message->user_id = $userId; // предполагается, что у вас есть аутентифицированный пользователь
        $message->save();

        return redirect()->back();
    }
    public function sendContactMessage(Request $request,$activeUserId)
    {
    // Ваш код для сохранения сообщения в базе данных

        $content = $request->input('message');

        if($content == null) {
            $message = "Сообщение не может быть пустым";
            return redirect()->back()->with('error', $message);
        }

        $contactsMessage = new ContactsMessage();
        $contactsMessage->content = $request->input('message');
        $contactsMessage->contact_Id = $request->input('contactId');
        // Добавьте user_id, если у вас есть отношение "один ко многим" с таблицей пользователей
        $contactsMessage->user_id = $activeUserId; // предполагается, что у вас есть аутентифицированный пользователь
        $contactsMessage->save();

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
