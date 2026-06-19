<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')
                ->unique()
                ->constrained('packages')
                ->cascadeOnDelete();

            $table->time('vreme_od')->nullable();
            $table->time('vreme_do')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_packages');
    }
};
