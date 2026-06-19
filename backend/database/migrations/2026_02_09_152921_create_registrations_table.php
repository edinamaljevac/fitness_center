<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')
                  ->constrained('members')
                  ->cascadeOnDelete();

            $table->foreignId('group_training_id')
                  ->constrained('group_trainings')
                  ->cascadeOnDelete();

            $table->date('datum_prijave');

            $table->string('status')->nullable();
            $table->boolean('prisustvovao')->nullable();
            $table->text('napomena')->nullable();

            $table->unique(['member_id', 'group_training_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
