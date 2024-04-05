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
        Schema::table('old_messages', function (Blueprint $table) {
            $table->dropColumn("from");
            $table->dropColumn("from_id");

            $table->addColumn("string","sender");
            $table->addColumn("string","sender_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('column_old_messages', function (Blueprint $table) {
            //
        });
    }
};
