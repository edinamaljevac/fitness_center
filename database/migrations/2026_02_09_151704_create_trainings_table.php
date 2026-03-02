<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                  ->constrained('members')
                  ->cascadeOnDelete();

            $table->foreignId('trainer_id')
                  ->nullable()
                  ->constrained('trainers')
                  ->nullOnDelete();

            $table->date('datum');
            $table->time('vreme_pocetka')->nullable();

            $table->unsignedSmallInteger('trajanje_min');

            $table->string('tip')->nullable();
            $table->text('napomena')->nullable();

            $table->unsignedTinyInteger('ocena')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
