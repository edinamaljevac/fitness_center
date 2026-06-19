<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                  ->constrained('members')
                  ->cascadeOnDelete();

            $table->date('datum_merenja');

            $table->decimal('tezina_kg', 5, 2)->nullable();
            $table->unsignedTinyInteger('procenat_masti')->nullable();

            $table->unsignedSmallInteger('obim_grudi')->nullable();
            $table->unsignedSmallInteger('obim_struka')->nullable();
            $table->unsignedSmallInteger('obim_kukova')->nullable();

            $table->unsignedSmallInteger('max_bench_kg')->nullable();
            $table->unsignedSmallInteger('max_cucanj_kg')->nullable();

            $table->text('napomena')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progresses');
    }
};
