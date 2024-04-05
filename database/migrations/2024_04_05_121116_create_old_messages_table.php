<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('old_messages', function (Blueprint $table) {
            $table->id();
            $table->string("date");
            $table->string("sender")->nullable();
            $table->string("sender_id")->nullable();
            $table->longText("text")->nullable();
            $table->string("reply_to_message_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('old_messages');
    }
};
