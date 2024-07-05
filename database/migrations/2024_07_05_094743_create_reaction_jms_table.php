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
        Schema::create('reaction_jms', function (Blueprint $table) {
            $table->id();
            $table->integer('jm');
            $table->foreignId('comment_id')->unique()->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reaction_jms', function (Blueprint $table) {
            $table->dropForeign(['comment_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('reaction_jms');
    }
};
