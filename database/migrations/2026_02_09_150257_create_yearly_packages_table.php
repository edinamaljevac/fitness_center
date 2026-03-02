<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yearly_packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')
                ->unique()
                ->constrained('packages')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('popust_procenat'); 
            $table->unsignedSmallInteger('zamrzavanje_dana')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yearly_packages');
    }
};
