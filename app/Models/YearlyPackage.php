<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearlyPackage extends Model
{
    protected $table = 'yearly_packages';

    protected $fillable = [
        'package_id',
        'popust_procenat',
        'zamrzavanje_dana',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
