<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();

            // FK → CLAN (members)
            $table->foreignId('member_id')
                  ->constrained('members')
                  ->cascadeOnDelete();

            // FK → PAKET
            $table->foreignId('package_id')
                  ->constrained('packages')
                  ->restrictOnDelete();

            $table->date('datum_pocetka');
            $table->date('datum_zavrsetka')->nullable();

            // za pakete sa treningima
            $table->unsignedSmallInteger('preostalo_treninga')
                  ->nullable();

            $table->boolean('aktivno')->default(true);

            $table->text('napomena')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
