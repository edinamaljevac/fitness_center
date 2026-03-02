<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'membership_id',
        'datum',
        'iznos',
        'nacin_placanja',
        'status',
        'broj_racuna',
        'napomena',
    ];

    protected $casts = [
        'datum' => 'date',
        'iznos' => 'decimal:2',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
