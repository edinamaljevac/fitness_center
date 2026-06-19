<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotReservation extends Model
{
    protected $fillable = [
        'training_slot_id',
        'member_id',
        'status'
    ];

    public function slot()
    {
        return $this->belongsTo(TrainingSlot::class, 'training_slot_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}

