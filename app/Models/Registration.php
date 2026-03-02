<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'member_id',
        'group_training_id',
        'datum_prijave',
        'status',
        'prisustvovao',
        'napomena',
    ];

    protected $casts = [
        'datum_prijave' => 'date',
        'prisustvovao' => 'boolean',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function groupTraining()
    {
        return $this->belongsTo(GroupTraining::class);
    }
}
