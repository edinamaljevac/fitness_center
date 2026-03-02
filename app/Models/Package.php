<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv',
        'opis',
        'cena',
        'trajanje_dana',
        'broj_treninga',
        'aktivan',
        'tip',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    
}
