<?php

namespace App\Services;

use App\Models\GroupTraining;
use App\Models\Registration;
use App\Models\Training;
use Carbon\Carbon;

class GroupRegistrationService
{
    public function createRegistration(GroupTraining $group, $member)
    {
        $start = Carbon::parse($group->vreme_pocetka);

        if ($start->isPast()) {
            throw new \Exception('Ne možete se prijaviti na trening koji je prošao.');
        }

        if ($group->registrations()
            ->where('member_id', $member->id)
            ->exists()) {
            throw new \Exception('Već ste poslali zahtev.');
        }

        if ($group->registrations()
            ->where('status', 'approved')
            ->count() >= $group->max_ucesnika) {
            throw new \Exception('Grupa je popunjena.');
        }

        return Registration::create([
            'group_training_id' => $group->id,
            'member_id'         => $member->id,
            'datum_prijave'     => now(),
            'status'            => 'pending'
        ]);
    }

    public function approveRegistration(Registration $registration)
    {
        $group = $registration->groupTraining;

        $approvedCount = $group->registrations()
            ->where('status', 'approved')
            ->count();

        if ($approvedCount >= $group->max_ucesnika) {
            throw new \Exception('Grupa je popunjena.');
        }

        $registration->update([
            'status' => 'approved'
        ]);

        Training::create([
            'member_id'      => $registration->member_id,
            'trainer_id'     => $group->trainer_id,
            'datum'          => $group->datum,
            'vreme_pocetka'  => $group->vreme_pocetka,
            'trajanje_min'   => $group->trajanje_min,
            'tip'            => 'group',
            'napomena'       => 'Grupni trening - ' . $group->naziv,
            'ocena'          => null
        ]);
    }

    public function rejectRegistration(Registration $registration)
    {
        $registration->update([
            'status' => 'rejected'
        ]);
    }
}