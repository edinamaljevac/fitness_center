<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;
use App\Models\Member;
use App\Models\Package;

class MembershipSeeder extends Seeder
{
    public function run(): void
    {
        $member = Member::first();
        $package = Package::first();

        Membership::create([
            'member_id' => $member->id,
            'package_id' => $package->id,
            'datum_pocetka' => now(),
            'aktivno' => true,
        ]);
    }
}
