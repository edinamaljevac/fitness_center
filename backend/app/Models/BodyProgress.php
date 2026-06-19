<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyProgress extends Model
{
    protected $table = 'progresses';

    protected $fillable = [
        'member_id',
        'datum_merenja',
        'tezina_kg',
        'procenat_masti',
        'obim_grudi',
        'obim_struka',
        'obim_kukova',
        'max_bench_kg',
        'max_cucanj_kg',
        'napomena',
    ];

    protected $casts = [
        'datum_merenja' => 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
