<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\GroupTraining;
use App\Models\Member;

class RegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $group = GroupTraining::first();
        $member = Member::first();

        Registration::create([
            'group_training_id' => $group->id,
            'member_id' => $member->id,
            'datum_prijave' => now(),
            'status' => 'pending',
        ]);
    }
}