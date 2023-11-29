<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    public function chats()
    {
        $activeUser = User::query()->first();


        $chats = Chat::with('owner', 'messages')->get();

        return view('chats', ['chats' => $chats]);
    }
}
