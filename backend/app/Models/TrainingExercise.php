<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TrainingExercise extends Pivot
{
    protected $table = 'training_exercise';

    protected $fillable = [
        'training_id',
        'exercise_id',
        'redosled',
        'broj_serija',
        'broj_ponavljanja',
        'tezina_kg',
        'odmor_sec',
        'napomena',
    ];
}
