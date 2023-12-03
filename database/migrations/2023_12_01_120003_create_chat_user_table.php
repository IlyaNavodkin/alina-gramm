<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatUserTable extends Migration
{
    public function up()
    {
        Schema::create('chat_user', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('chat_id');
            $table->boolean('blocked')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');

            $table->primary(['user_id', 'chat_id']);
            $table->index(['user_id', 'chat_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_user');
    }
}