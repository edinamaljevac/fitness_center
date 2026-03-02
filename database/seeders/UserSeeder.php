<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Trainer',
            'email' => 'trainer@test.com',
            'password' => Hash::make('password'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'Member',
            'email' => 'member@test.com',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);
    }
}
