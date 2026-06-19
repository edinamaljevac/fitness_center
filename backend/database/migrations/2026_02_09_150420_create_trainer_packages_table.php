<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trainer_packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')
                ->unique()
                ->constrained('packages')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('broj_treninga');
            $table->string('tip_treninga')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trainer_packages');
    }
};
