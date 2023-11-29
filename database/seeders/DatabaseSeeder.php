<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Chat::factory(5)->create();
        \App\Models\Message::factory(20)->create();
        \App\Models\Contact::factory(15)->create();
        \App\Models\ChatUser::factory(20)->create();
    }
}
