<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyPackage extends Model
{
    protected $table = 'monthly_packages';

    protected $fillable = [
        'package_id',
        'broj_dolazaka',
        'ukljucuje_grupne',
    ];

    protected $casts = [
        'ukljucuje_grupne' => 'boolean',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
