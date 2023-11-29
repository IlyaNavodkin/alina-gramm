<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class MainController extends Controller
{
    public function home(){

        $chats = Chat::with('owner', 'messages')->get();


        return view('home', ['chats' => $chats]);
    }
}
