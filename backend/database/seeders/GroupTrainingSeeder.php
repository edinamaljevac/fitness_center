<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroupTraining;
use App\Models\Trainer;
use Carbon\Carbon;

class GroupTrainingSeeder extends Seeder
{
    public function run(): void
    {
        $trainer = Trainer::first();

        GroupTraining::create([
            'naziv' => 'HIIT Trening',
            'datum' => Carbon::now()->addDays(2),
            'vreme_pocetka' => '18:00:00',
            'trajanje_min' => 60,
            'max_ucesnika' => 10,
            'trainer_id' => $trainer->id,
        ]);

        GroupTraining::create([
            'naziv' => 'Core & Abs',
            'datum' => Carbon::now()->addDays(4),
            'vreme_pocetka' => '19:30:00',
            'trajanje_min' => 45,
            'max_ucesnika' => 8,
            'trainer_id' => $trainer->id,
        ]);
    }
}