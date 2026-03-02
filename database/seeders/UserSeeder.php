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
            'email' => 'admin@gym.rs',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Nikola Jovanović',
            'email' => 'nikola.trener@gmail.rs',
            'password' => Hash::make('password'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'Ivana Stanković',
            'email' => 'ivana.trener@gmail.rs',
            'password' => Hash::make('password'),
            'role' => 'trainer',
        ]);

        User::create([
            'name' => 'Luka Milenković',
            'email' => 'luka.member@gmail.rs',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);

        User::create([
            'name' => 'Milica Đorđević',
            'email' => 'milica.member@gmail.rs',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);
    }
}