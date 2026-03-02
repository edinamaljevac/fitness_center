<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainerPackage extends Model
{
    protected $table = 'trainer_packages';

    protected $fillable = [
        'package_id',
        'broj_treninga',
        'tip_treninga',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
