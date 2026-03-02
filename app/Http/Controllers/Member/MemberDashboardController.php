<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\GroupTraining;
use App\Models\TrainingSlot;
use App\Models\Registration;
use App\Models\SlotReservation;
use App\Models\Training;
use App\Models\BodyProgress;
use Illuminate\Http\Request;

class MemberDashboardController extends Controller
{
    public function index()
    {
        $member = Auth::user()->member;

        $activeMembership = $member->memberships()
            ->where('aktivno', true)
            ->whereDate('datum_zavrsetka', '>=', now())
            ->with('package')
            ->first();

        $payments = $member->memberships()
            ->with('payments')
            ->get()
            ->pluck('payments')
            ->flatten();

        $totalVisits = $member->attendances()->count();

        $monthlyVisits = $member->attendances()
            ->whereMonth('datum', now()->month)
            ->count();

        $totalMinutes = $member->attendances()
            ->whereNotNull('vreme_izlaska')
            ->get()
            ->sum(function ($attendance) {
                return Carbon::parse($attendance->vreme_ulaska)
                    ->diffInMinutes($attendance->vreme_izlaska);
            });

        return view('member.dashboard', compact(
            'member',
            'activeMembership',
            'payments',
            'totalVisits',
            'monthlyVisits',
            'totalMinutes'
        ));
    }

    public function attendances()
    {
        $member = Auth::user()->member;

        $attendances = $member->attendances()
            ->latest()
            ->get();

        return view('member.attendances', compact('attendances'));
    }

    public function groupTrainings()
    {
        $member = Auth::user()->member;
        $now = Carbon::now();

        $groups = GroupTraining::with('trainer')
            ->whereDoesntHave('registrations', function ($q) use ($member) {
                $q->where('member_id', $member->id)
                ->where('status', 'approved');
            })
            ->get()
            ->filter(function ($group) use ($now) {
                // 🔥 vreme_pocetka već sadrži datum + vreme
                $start = Carbon::parse($group->vreme_pocetka);
                return $start->isFuture();
            });

        $registrations = Registration::where('member_id', $member->id)
            ->whereIn('group_training_id', $groups->pluck('id'))
            ->get()
            ->keyBy('group_training_id');

        return view('member.group.index', compact('groups', 'registrations'));
    }

   public function slots()
{
    $member = Auth::user()->member;

    $slots = TrainingSlot::with('trainer.user')
        ->where('tip', 'T')
        ->whereDate('datum', '>=', now())
        ->orderBy('datum')
        ->orderBy('vreme_pocetka')
        ->get();

    $reservations = SlotReservation::where('member_id', $member->id)
        ->whereIn('training_slot_id', $slots->pluck('id'))
        ->get()
        ->keyBy('training_slot_id');

    return view('member.slots.index', compact('slots','reservations'));
}

    public function myTrainings()
    {
        $member = Auth::user()->member;

        $trainings = Training::with('trainer')
            ->where('member_id', $member->id)
            ->orderBy('datum', 'desc')
            ->get();

        return view('member.trainings.index', compact('trainings'));
    }

    public function rateTraining(Request $request, Training $training)
    {
        $request->validate([
            'ocena' => 'required|integer|min:1|max:5'
        ]);

        if ($training->member_id !== Auth::user()->member->id) {
            abort(403);
        }

        $training->update([
            'ocena' => $request->ocena
        ]);

        return back()->with('success', 'Trening uspešno ocenjen.');
    }

    public function progress()
    {
        $member = Auth::user()->member;

        $progresses = BodyProgress::where('member_id', $member->id)
            ->orderByDesc('datum_merenja')
            ->get();

        return view('member.progress.index', compact('progresses'));
    }

    public function showTraining(Training $training)
    {
        $member = Auth::user()->member;

        if ((int)$training->member_id !== (int)$member->id) {
            abort(403);
        }

        $training->load(['trainer.user', 'exercises']);

        return view('member.trainings.show', compact('training'));
    }
}