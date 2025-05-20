<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('surah_number');
            $table->unsignedInteger('ayat_number');
            $table->timestamps();

            $table->unique(['user_id', 'surah_number', 'ayat_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
