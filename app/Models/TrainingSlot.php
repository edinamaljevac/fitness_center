<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSlot extends Model
{
    protected $fillable = [
        'trainer_id',
        'datum',
        'vreme_pocetka',
        'trajanje_min',
        'tip',
        'max_clanova',
        'status',
    ];

    protected $casts = [
        'datum' => 'date',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function reservations()
    {
        return $this->hasMany(SlotReservation::class);
    }
}
