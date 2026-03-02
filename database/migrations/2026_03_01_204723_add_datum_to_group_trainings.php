<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('group_trainings', function (Blueprint $table) {
            $table->date('datum')->nullable()->after('dan_u_nedelji');
        });
    }

    public function down(): void
    {
        Schema::table('group_trainings', function (Blueprint $table) {
            $table->dropColumn('datum');
        });
    }
};