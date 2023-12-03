<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->boolean('banned')->default(false);
            $table->enum('roles', ['user', 'admin'])->default('user');
            $table->string('login')->unique();
            $table->string('avatar')->default('media/users/avatars/default.png');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
