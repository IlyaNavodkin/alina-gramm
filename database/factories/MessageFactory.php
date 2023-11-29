<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = \App\Models\Message::class;

    public function definition()
    {
        return [
            'chat_id' => \App\Models\Chat::factory(),
            'user_id' => \App\Models\User::factory(),
            'reply_message_id' => null,
            'content' => $this->faker->sentence,
        ];
    }
}
