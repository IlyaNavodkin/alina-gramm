<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessagesController extends Controller
{
    public function messages(){
        $messages = Message::with('user', 'chat')->get();

        // $firstMessage = Message::with(['user', 'chat'])->first();

        // $firstMessageChat = $firstMessage->chat;
        // $firstMessageUser = $firstMessage->user;

        return view('messages', ['messages' => $messages]);
    }

    public function sendMessage(Request $request, $chatId, $userId)
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
}
