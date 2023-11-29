<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('user_id_from');
            $table->unsignedBigInteger('user_id_to');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->boolean('blocked')->default(false);

            $table->foreign('user_id_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id_to')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['user_id_from', 'user_id_to']);
            $table->index(['user_id_from', 'user_id_to']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
