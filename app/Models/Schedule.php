<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'trainer_id',
        'group_training_id',
        'dan_u_nedelji',
        'vreme_od',
        'vreme_do',
        'tip_aktivnosti',
        'napomena',
    ];

    protected $casts = [
        'vreme_od' => 'datetime:H:i',
        'vreme_do' => 'datetime:H:i',
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function groupTraining()
    {
        return $this->belongsTo(GroupTraining::class);
    }
}
