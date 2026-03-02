<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();

            $table->string('naziv')->unique();
            $table->string('kategorija')->nullable();
            $table->text('opis')->nullable();
            $table->string('oprema')->nullable();
            $table->string('misicna_grupa')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
