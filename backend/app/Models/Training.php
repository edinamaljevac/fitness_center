<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'member_id',
        'trainer_id',
        'datum',
        'vreme_pocetka',
        'trajanje_min',
        'tip',
        'napomena',
        'ocena',
    ];

    protected $casts = [
        'datum' => 'date',
        'zavrsen' => 'boolean', 
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'training_exercise')
            ->withPivot([
                'redosled',
                'broj_serija',
                'broj_ponavljanja',
                'tezina_kg',
                'odmor_sec',
                'napomena',
            ]);
    }
}
