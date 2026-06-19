<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('training_slots', function (Blueprint $table) {
        $table->id();

        $table->foreignId('trainer_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->date('datum');
        $table->time('vreme_pocetka');
        $table->integer('trajanje_min');

        $table->string('tip'); 
        $table->integer('max_clanova')->default(1);

        $table->enum('status', ['open', 'closed'])
              ->default('open');

        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('training_slots');
    }
};
