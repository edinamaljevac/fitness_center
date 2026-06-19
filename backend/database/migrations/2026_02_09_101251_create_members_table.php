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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->date('datum_rodjenja')->nullable();
            $table->string('adresa')->nullable();

            $table->date('datum_uclanjenja');

            $table->enum('status', ['aktivno', 'pauzirano', 'isteklo'])
                  ->default('aktivno');

            $table->unsignedSmallInteger('visina_cm')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
