<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\User;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'member')->first();

        Member::create([
            'user_id' => $user->id,
            'datum_uclanjenja' => now(),
            'status' => 'aktivno',
        ]);
    }
}
