<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    protected $model = \App\Models\Chat::class;

    public function definition()
    {
        return [
            'owner_id' => \App\Models\User::factory(),
            'topic' => $this->faker->sentence,
        ];
    }
}
