<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            // FK → TRENER
            $table->foreignId('trainer_id')
                  ->constrained('trainers')
                  ->cascadeOnDelete();

            // FK → GRUPNI_TRENING
            $table->foreignId('group_training_id')
                  ->constrained('group_trainings')
                  ->cascadeOnDelete();

            $table->string('dan_u_nedelji')->nullable();

            $table->time('vreme_od')->nullable();
            $table->time('vreme_do')->nullable();

            $table->string('tip_aktivnosti')->nullable();
            $table->text('napomena')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
