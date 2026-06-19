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
        $members = Member::all();

        foreach ($members as $member) {

            $standardPackage = Package::where('tip', 'M')->first();

            Membership::create([
                'member_id' => $member->id,
                'package_id' => $standardPackage->id,
                'datum_pocetka' => now(),
                'datum_zavrsetka' => now()->addDays(30),
                'aktivno' => true,
            ]);

            if ($member->id === 1) {

                $personalPackage = Package::where('tip', 'T')->first();

                Membership::create([
                    'member_id' => $member->id,
                    'package_id' => $personalPackage->id,
                    'datum_pocetka' => now(),
                    'datum_zavrsetka' => now()->addDays(30),
                    'preostalo_treninga' => 8,
                    'aktivno' => true,
                ]);
            }
        }
    }
}