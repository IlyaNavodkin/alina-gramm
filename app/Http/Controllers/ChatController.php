<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    public function chats()
    {
        // $user = User::find(1);

        // // $user->chats->load('owner'); // так грузим чаты
        // $user->load('chats.owner'); // или так
        // return $user;

        // $chats = $user->chats()->with('owner')->get();
        // return $chats;

        // return view('chats', ['chats' => $activeUser->chats]);

        $chats = Chat::all();
        $chats->load('owner')->load('users')->load('messages');

        // return $chats;
        return view('chats', ['chats' => $chats]);
    }

    public function enterChat($chatId, $userId)
    {
        $chat = Chat::find($chatId);
        $chat->load('owner')->load('users')->load('messages')->load('messages.user');

        $user = User::find($userId);

        // return $chat;
        return view('chat', compact('chat', 'user'));
    }

    public function exitChat($chatId, $userId)
    {
        // Находим чат по ID
        $chat = Chat::findOrFail($chatId);

        // Находим пользователя по ID
        $user = User::findOrFail($userId);

        // Проверяем, присутствует ли пользователь в данном чате
        if ($chat->users()->where('user_id', $user->id)->exists()) {
            // Удаляем пользователя из чата
            $chat->users()->detach($user->id);

            // Можете также добавить дополнительные действия при выходе из чата

            // Например, перенаправление обратно на страницу с чатами
            return redirect()->route('users.getChats', ['id' => $user->id])->with('success', 'Вы успешно вышли из чата.');
        } else {
            // Если пользователь не найден в чате, обрабатываем ошибку или перенаправляем на страницу с чатами с сообщением
            return redirect()->route('users.getChats', ['id' => $user->id])->with('error', 'Вы не присутствуете в данном чате.');
        }
    }

    public function addChat($chatId, $userId)
{
    // Находим пользователя по ID
    $user = User::findOrFail($userId);

    // Создаем новый чат или находим существующий по ID
    $chat = Chat::firstOrNew(['id' => $chatId]);

    // Сохраняем чат, если он был новым
    if (!$chat->exists) {
        $chat->save();
    }

    // Проверяем, что пользователь еще не присутствует в данном чате
    if (!$chat->users()->where('user_id', $user->id)->exists()) {
        // Присоединяем пользователя к чату
        $chat->users()->attach($user->id);

        // Можете также добавить дополнительные действия при добавлении пользователя в чат

        // Например, перенаправление обратно на страницу с чатами
        return redirect()->route('users.getChats', ['id' => $user->id])->with('success', 'Чат успешно добавлен.');
    } else {
        // Если пользователь уже присутствует в чате, обрабатываем ошибку или перенаправляем на страницу с чатами с сообщением
        return redirect()->route('users.getChats', ['id' => $user->id])->with('error', 'Вы уже добавлены в этот чат.');
    }
}
}
