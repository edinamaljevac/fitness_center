<?php

namespace App\Services;

use App\Models\User;
use App\Models\Member;
use App\Models\Trainer;
use Illuminate\Support\Facades\Hash;

class RegistrationService
{
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        if ($data['role'] === 'member') {
            Member::create([
                'user_id' => $user->id,
                'datum_uclanjenja' => now(),
                'status' => 'aktivno',
            ]);
        }

        if ($data['role'] === 'trainer') {
            Trainer::create([
                'user_id' => $user->id,
                'status' => 'aktivan',
            ]);
        }

        return $user;
    }
}
