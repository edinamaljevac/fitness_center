<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trainer;
use App\Models\User;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $trainers = User::where('role', 'trainer')->get();

        foreach ($trainers as $user) {
            Trainer::create([
                'user_id' => $user->id,
                'oblast_rada' => 'Fitness & Personal Training',
                'datum_zaposlenja' => now(),
                'dostupnost' => true,
            ]);
        }
    }
}