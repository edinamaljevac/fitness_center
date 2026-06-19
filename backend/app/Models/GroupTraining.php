<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupTraining extends Model
{
    protected $fillable = [
        'naziv',
        'dan_u_nedelji',
        'datum',
        'vreme_pocetka',
        'trajanje_min',
        'max_ucesnika',
        'opis',
        'sala',
        'trainer_id',
    ];

    protected $casts = [
        'vreme_pocetka' => 'datetime:H:i',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    
}
