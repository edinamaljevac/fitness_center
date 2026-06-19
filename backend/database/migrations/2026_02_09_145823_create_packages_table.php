<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->string('naziv')->unique();
            $table->text('opis')->nullable();

            $table->decimal('cena', 10, 2);
            $table->unsignedSmallInteger('trajanje_dana');

            $table->boolean('aktivan')->default(true);

            $table->enum('tip', ['M', 'G', 'D', 'T']);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
