<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Member;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected AttendanceService $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        $attendances = Attendance::with('member.user')
            ->latest()
            ->get();

        return view('admin.attendances.index', compact('attendances'));
    }

    public function checkIn(Member $member)
    {
        if (!$this->attendanceService->hasActiveMembership($member)) {
        return back()->with('error', 'Član nema aktivno članstvo.');
        }
        
        if ($this->attendanceService->alreadyCheckedInToday($member)) {
            return back()->with('error', 'Član je već prijavljen danas.');
        }

        $this->attendanceService->checkIn($member);

        
        return back()->with('success', 'Dolazak uspešno evidentiran.');
    }

    public function checkOut(Attendance $attendance)
    {
        if ($attendance->vreme_izlaska) {
            return back()->with('error', 'Izlazak je već evidentiran.');
        }

        $this->attendanceService->checkOut($attendance);

        return back()->with('success', 'Izlazak uspešno evidentiran.');
    }
}
