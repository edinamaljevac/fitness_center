<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trainer;
use App\Models\User;

class TrainerSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'trainer')->first();

        Trainer::create([
            'user_id' => $user->id,
            'oblast_rada' => 'Personalni trening',
            'datum_zaposlenja' => now(),
            'dostupnost' => true,
        ]);
    }
}
