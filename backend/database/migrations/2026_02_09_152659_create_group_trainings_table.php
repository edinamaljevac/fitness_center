<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_trainings', function (Blueprint $table) {
            $table->id();

            $table->string('naziv');
            $table->string('dan_u_nedelji')->nullable();

            $table->time('vreme_pocetka')->nullable();
            $table->unsignedSmallInteger('trajanje_min');

            $table->unsignedSmallInteger('max_ucesnika');

            $table->text('opis')->nullable();
            $table->string('sala')->nullable();

            $table->foreignId('trainer_id')
                  ->nullable()
                  ->constrained('trainers')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_trainings');
    }
};
