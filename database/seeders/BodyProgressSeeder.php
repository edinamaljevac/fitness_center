<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BodyProgress;
use App\Models\Member;
use Carbon\Carbon;

class BodyProgressSeeder extends Seeder
{
    public function run(): void
    {
        $member = Member::first();

        BodyProgress::create([
            'member_id' => $member->id,
            'tezina' => 82,
            'procenat_masti' => 18,
            'misicna_masa' => 40,
            'datum_merenja' => Carbon::now()->subMonths(2),
        ]);

        BodyProgress::create([
            'member_id' => $member->id,
            'tezina' => 79,
            'procenat_masti' => 15,
            'misicna_masa' => 42,
            'datum_merenja' => Carbon::now(),
        ]);
    }
}