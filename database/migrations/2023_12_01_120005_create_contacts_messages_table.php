<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('contacts_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('contact_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reply_message_id')->nullable();
            $table->string('content');

            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reply_message_id')->references('id')->on('contacts_messages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts_messages');
    }
}
