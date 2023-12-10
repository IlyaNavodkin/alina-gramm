<?php

namespace App\Http\Controllers;

use App\Models\ContactsMessage;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

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
    public function sendContactMessage(Request $request)
    {
        $content = $request->input('content');
        $contactId = $request->input('contact_id'); // изменено имя переменной

        $activeUser = Auth::user();

        if($content == null) {
            $message = "Сообщение не может быть пустым";
            return redirect()->back()->with('error', $message);
        }

        $contactsMessage = new ContactsMessage();
        $contactsMessage->content = $content;
        $contactsMessage->contact_Id = $contactId;
        $contactsMessage->user_id = $activeUser->id;

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
