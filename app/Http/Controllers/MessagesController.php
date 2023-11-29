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
}
