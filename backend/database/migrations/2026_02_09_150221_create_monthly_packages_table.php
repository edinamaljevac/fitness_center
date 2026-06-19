<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_packages', function (Blueprint $table) {
            $table->id();

            // id PK FK → PAKET(id)
            $table->foreignId('package_id')
                ->unique()
                ->constrained('packages')
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('broj_dolazaka');
            $table->boolean('ukljucuje_grupne')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_packages');
    }
};
