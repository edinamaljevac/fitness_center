<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    public function getDashboardData(Member $member)
    {
        $activeMembership = $member->memberships()
            ->where('aktivno', true)
            ->with('package')
            ->first();

        $payments = $member->memberships()
            ->with('payments')
            ->get()
            ->pluck('payments')
            ->flatten();

        return [
            'member' => $member,
            'activeMembership' => $activeMembership,
            'payments' => $payments,
        ];
    }

    public function updateProfile($member, $data)
    {
    $member->update([
        'datum_rodjenja' => $data['datum_rodjenja'] ?? $member->datum_rodjenja,
        'adresa' => $data['adresa'] ?? $member->adresa,
        'visina_cm' => $data['visina_cm'] ?? $member->visina_cm,
    ]);
    }
}
