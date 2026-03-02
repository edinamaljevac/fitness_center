<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Member;
use App\Models\Package;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::with(['member.user', 'package'])
            ->orderByDesc('created_at')
            ->get();

        $today = Carbon::today();

        return view('admin.memberships.index', compact('memberships', 'today'));
    }

    public function create()
    {
        $members = Member::with('user')->get();
        $packages = Package::where('aktivan', true)->get();

        return view('admin.memberships.create', compact('members', 'packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'package_id' => 'required|exists:packages,id',
            'datum_pocetka' => 'required|date',
        ]);

        $package = Package::findOrFail($request->package_id);

        $start = Carbon::parse($request->datum_pocetka)->startOfDay();
        $end = $start->copy()->addDays((int)$package->trajanje_dana);

        // ✅ aktivno samo ako je start <= danas
        $isActiveNow = $start->lte(Carbon::today());

        Membership::create([
            'member_id' => $request->member_id,
            'package_id' => $request->package_id,
            'datum_pocetka' => $start->toDateString(),
            'datum_zavrsetka' => $end->toDateString(),
            'preostalo_treninga' => $package->tip === 'T'
                ? $package->broj_treninga
                : null,
            'aktivno' => $isActiveNow,
        ]);

        // ✅ status člana menjamo samo ako članstvo važi odmah
        if ($isActiveNow) {
            Member::where('id', $request->member_id)
                ->update(['status' => 'aktivno']);
        }

        return redirect()
            ->route('admin.memberships.index')
            ->with('success', 'Članstvo uspešno kreirano.');
    }

    public function show(Membership $membership)
    {
        $membership->load(['member.user', 'package']);

        return view('admin.memberships.show', compact('membership'));
    }

    public function deactivate(Membership $membership)
    {
        $membership->update([
            'aktivno' => false,
            'datum_zavrsetka' => now()->toDateString(),
        ]);

        return back()->with('success', 'Članstvo je deaktivirano.');
    }
}