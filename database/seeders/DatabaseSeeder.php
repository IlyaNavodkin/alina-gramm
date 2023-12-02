<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // \App\Models\User::factory(4)->create();
        // \App\Models\Chat::factory(3)->create();
        // \App\Models\Message::factory(100)->create();
        // \App\Models\Contact::factory(4)->create();
        \App\Models\ChatUser::factory(5)->create();
    }
}
