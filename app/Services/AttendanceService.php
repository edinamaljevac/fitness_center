<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Member;
use Carbon\Carbon;

class AttendanceService
{
    public function checkIn(Member $member): Attendance
    {
        return Attendance::create([
            'member_id' => $member->id,
            'datum'         => now()->toDateString(),
            'vreme_ulaska'  => now()->toTimeString(),
            'vreme_izlaska' => null,
        ]);
    }

    public function checkOut(Attendance $attendance): Attendance
    {
        $attendance->update([
            'vreme_izlaska' => now()->toTimeString(),
        ]);

        return $attendance;
    }

    public function alreadyCheckedInToday(Member $member): bool
    {
        return Attendance::where('member_id', $member->id)
            ->whereDate('datum', now()->toDateString())
            ->whereNull('vreme_izlaska')
            ->exists();
    }

    public function hasActiveMembership(Member $member): bool
    {
    return $member->memberships()
        ->where('aktivno', true)
        ->where(function ($q) {
            $q->whereNull('datum_zavrsetka')
              ->orWhere('datum_zavrsetka', '>=', now()->toDateString());
        })
        ->exists();
    }
}
