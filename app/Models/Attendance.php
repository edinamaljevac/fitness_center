<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'member_id',
        'datum',
        'vreme_ulaska',
        'vreme_izlaska',
    ];

    protected $casts = [
        'datum' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
