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

    public function monthlyPackage()
    {
        return $this->hasOne(MonthlyPackage::class);
    }

    public function yearlyPackage()
    {
        return $this->hasOne(YearlyPackage::class);
    }

    public function dailyPackage()
    {
        return $this->hasOne(DailyPackage::class);
    }

    public function trainerPackage()
    {
        return $this->hasOne(TrainerPackage::class);
    }
}
