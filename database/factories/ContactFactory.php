<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = \App\Models\Contact::class;

    public function definition()
    {
        return [
            'user_id_from' => \App\Models\User::factory(),
            'user_id_to' => \App\Models\User::factory(),
            'status' => $this->faker->randomElement(['pending', 'accepted', 'rejected']),
            'blocked' => false,
        ];
    }
}
