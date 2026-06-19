<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('daily_packages');
        Schema::dropIfExists('trainer_packages');
        Schema::dropIfExists('yearly_packages');
        Schema::dropIfExists('monthly_packages');
        Schema::dropIfExists('schedules');
    }

    public function down(): void
    {
        //
    }
};