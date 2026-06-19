<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingSlot;
use App\Models\Trainer;
use Carbon\Carbon;

class TrainingSlotSeeder extends Seeder
{
    public function run(): void
    {
        $trainer = Trainer::first();

        TrainingSlot::create([
            'trainer_id' => $trainer->id,
            'datum' => Carbon::now()->addDays(3),
            'vreme_pocetka' => '10:00:00',
            'trajanje_min' => 45,
            'status' => 'open',
            'tip' => 'T',
            'max_clanova' => 1,
        ]);

        TrainingSlot::create([
            'trainer_id' => $trainer->id,
            'datum' => Carbon::now()->addDays(5),
            'vreme_pocetka' => '14:45:00',
            'trajanje_min' => 45,
            'status' => 'open',
            'tip' => 'T',
            'max_clanova' => 1,
        ]);
    }
}