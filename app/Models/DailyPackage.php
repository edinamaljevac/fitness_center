<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyPackage extends Model
{
    protected $table = 'daily_packages';

    protected $fillable = [
        'package_id',
        'vreme_od',
        'vreme_do',
    ];

    protected $casts = [
        'vreme_od' => 'datetime:H:i',
        'vreme_do' => 'datetime:H:i',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
