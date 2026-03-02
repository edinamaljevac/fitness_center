<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\TrainingSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerSlotController extends Controller
{
    public function create()
    {
        return view('trainer.slots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'datum' => 'required|date',
            'vreme_pocetka' => 'required',
            'trajanje_min' => 'required|integer|min:1',
        ]);

        $trainer = Auth::user()->trainer;

        $newStart = Carbon::parse($request->datum)
            ->setTimeFromTimeString($request->vreme_pocetka);

        if ($newStart->isPast()) {
            return back()
                ->withInput()
                ->with('error', 'Ne možete kreirati termin u prošlosti.');
        }

        $newEnd = $newStart->copy()
            ->addMinutes((int)$request->trajanje_min);

        $existingSlots = TrainingSlot::where('trainer_id', $trainer->id)
            ->whereDate('datum', $request->datum)
            ->get();

        foreach ($existingSlots as $slot) {

            $existingStart = Carbon::parse($slot->datum)
                ->setTimeFromTimeString($slot->vreme_pocetka);

            $existingEnd = $existingStart->copy()
                ->addMinutes((int)$slot->trajanje_min);

            if ($newStart < $existingEnd && $newEnd > $existingStart) {
                return back()
                    ->withInput()
                    ->with('error',
                        'Termin se preklapa sa postojećim terminom (' .
                        $existingStart->format('H:i') . ' - ' .
                        $existingEnd->format('H:i') . ').'
                    );
            }
        }

        TrainingSlot::create([
            'trainer_id'    => $trainer->id,
            'datum'         => $request->datum,
            'vreme_pocetka' => $request->vreme_pocetka,
            'trajanje_min'  => $request->trajanje_min,
            'tip'           => 'T',
            'max_clanova'   => 1,
            'status'        => 'open'
        ]);

        return redirect()
            ->route('trainer.slots.create')
            ->with('success', 'Personalni termin je uspešno kreiran.');
    }

    public function index()
    {
        $trainer = Auth::user()->trainer;

        $slots = TrainingSlot::where('trainer_id', $trainer->id)
            ->orderBy('datum', 'asc')
            ->orderBy('vreme_pocetka', 'asc')
            ->get();

        $now = Carbon::now();

        foreach ($slots as $slot) {

            $start = Carbon::parse($slot->datum)
                ->setTimeFromTimeString($slot->vreme_pocetka);

            $end = $start->copy()
                ->addMinutes((int)$slot->trajanje_min);

            if ($end->isPast() && $slot->status === 'open') {
                $slot->update([
                    'status' => 'closed'
                ]);
            }
        }

        return view('trainer.slots.index', compact('slots'));
    }
}