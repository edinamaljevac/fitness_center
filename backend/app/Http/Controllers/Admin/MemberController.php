<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')->get();

        return view('admin.members.index', compact('members'));
    }

    public function show(Member $member)
    {
        $member->load(['user', 'memberships.package']);

        $todayAttendance = $member->attendances()
            ->where('datum', now()->toDateString())
            ->whereNull('vreme_izlaska')
            ->first();

        return view('admin.members.show', compact('member', 'todayAttendance'));
    }


    public function updateStatus(Request $request, Member $member)
    {
        $request->validate([
            'status' => 'required|in:aktivno,pauzirano,isteklo',
        ]);

        $member->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status članstva je uspešno ažuriran.');
    }
}
