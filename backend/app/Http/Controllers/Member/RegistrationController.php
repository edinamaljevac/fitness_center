<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\GroupTraining;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function store(GroupTraining $group)
    {
        $member = Auth::user()->member;

        if ($group->registrations()
            ->where('member_id', $member->id)
            ->exists()) {

            return back()->with('error', 'Već ste prijavljeni na ovaj trening.');
        }

        if ($group->registrations()
            ->where('status', 'approved')
            ->count() >= $group->max_ucesnika) {

            return back()->with('error', 'Grupa je popunjena.');
        }

        $group->registrations()->create([
            'member_id' => $member->id,
            'datum_prijave' => now(),
            'status' => 'pending'
        ]);

        return back()->with('success', 'Zahtev za prijavu je poslat.');
    }
}
