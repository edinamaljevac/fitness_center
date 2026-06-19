<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $fillable = [
        'user_id',
        'oblast_rada',
        'datum_zaposlenja',
        'dostupnost',
        'sertifikat',
    ];

    protected $casts = [
        'datum_zaposlenja' => 'date',
        'dostupnost' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groupTrainings()
    {
        return $this->hasMany(GroupTraining::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function trainingSlots()
    {
        return $this->hasMany(TrainingSlot::class);
    }

    public function averageRating()
    {
        return $this->trainings()
            ->whereNotNull('ocena')
            ->avg('ocena');
    }

}
