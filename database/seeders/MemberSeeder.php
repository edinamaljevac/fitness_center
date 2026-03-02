<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\User;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = User::where('role', 'member')->get();

        foreach ($members as $user) {
            Member::create([
                'user_id' => $user->id,
                'datum_uclanjenja' => now(),
                'status' => 'aktivno',
            ]);
        }
    }
}