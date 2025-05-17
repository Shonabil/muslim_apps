<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDzikirsTable extends Migration
{
    public function up()
    {
        Schema::create('dzikirs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('arabic_text')->nullable();
            $table->text('latin_translation')->nullable();
            $table->text('translation')->nullable();
            $table->text('fadhilah')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dzikirs');
    }
}
