<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_exercise', function (Blueprint $table) {

            $table->foreignId('training_id')
                  ->constrained('trainings')
                  ->cascadeOnDelete();

            $table->foreignId('exercise_id')
                  ->constrained('exercises')
                  ->cascadeOnDelete();

            $table->unsignedSmallInteger('redosled')->nullable();
            $table->unsignedSmallInteger('broj_serija');
            $table->unsignedSmallInteger('broj_ponavljanja');
            $table->unsignedSmallInteger('tezina_kg')->nullable();
            $table->unsignedSmallInteger('odmor_sec')->nullable();

            $table->text('napomena')->nullable();

            $table->primary(['training_id', 'exercise_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_exercise');
    }
};
