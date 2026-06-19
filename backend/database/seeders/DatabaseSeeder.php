<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MemberSeeder::class,
            TrainerSeeder::class,
            PackageSeeder::class,
            MembershipSeeder::class,
            TrainingSlotSeeder::class,
            GroupTrainingSeeder::class,
            RegistrationSeeder::class,
            BodyProgressSeeder::class,
        ]);
    }
}
