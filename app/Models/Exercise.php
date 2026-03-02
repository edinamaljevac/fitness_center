<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'naziv',
        'kategorija',
        'opis',
        'oprema',
        'misicna_grupa',
    ];

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_exercise')
            ->withPivot([
                'redosled',
                'broj_serija',
                'broj_ponavljanja',
                'tezina_kg',
                'odmor_sec',
                'napomena',
            ])
            ->withTimestamps();
    }
}
