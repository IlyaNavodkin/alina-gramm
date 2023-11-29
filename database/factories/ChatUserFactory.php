<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChatUserFactory extends Factory
{
    protected $model = \App\Models\ChatUser::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'chat_id' => \App\Models\Chat::factory(),
            'blocked' => false,
        ];
    }
}
