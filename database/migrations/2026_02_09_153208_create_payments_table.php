<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // FK → CLANSTVO (memberships)
            $table->foreignId('membership_id')
                  ->constrained('memberships')
                  ->cascadeOnDelete();

            $table->date('datum');

            $table->decimal('iznos', 10, 2);

            $table->string('nacin_placanja')->nullable();
            $table->string('status')->nullable();
            $table->string('broj_racuna')->nullable();

            $table->text('napomena')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
