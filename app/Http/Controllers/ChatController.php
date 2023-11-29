<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::all();
        return view('chats.index', compact('chats'));
    }

    public function getChatMessages(Chat $chat)
    {
        $messages = $chat->messages;
        return view('chats.messages', compact('chat', 'messages'));
    }

    public function getChatUsers(Chat $chat)
    {
        $users = $chat->users;
        return view('chats.users', compact('chat', 'users'));
    }
}
