<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerTrainingController extends Controller
{
    public function index()
    {
        $trainer = Auth::user()->trainer;

        $trainings = Training::with(['member.user'])
            ->where('trainer_id', $trainer->id)
            ->orderBy('datum', 'desc')
            ->orderBy('vreme_pocetka', 'desc')
            ->get();

        return view('trainer.trainings.index', compact('trainings'));
    }

    public function edit(Training $training)
    {
        $trainer = Auth::user()->trainer;

        // Security: trener može editovati samo svoje treninge
        if ((int)$training->trainer_id !== (int)$trainer->id) {
            abort(403);
        }

        $trainingDateTime = Carbon::parse($training->datum)
        ->setTimeFromTimeString($training->vreme_pocetka);

    // ❌ Ako je u budućnosti
        if ($trainingDateTime->isFuture()) {
            return redirect()
                ->route('trainer.trainings.index')
                ->with('error', 'Vežbe možete uneti tek nakon održanog treninga.');
        }

        // Lock: prošli treninzi su read-only
        $locked = Carbon::parse($training->datum)->lt(Carbon::today());

        $exercises = Exercise::orderBy('naziv')->get();

        // Postojeće vežbe sa pivotom (za edit)
        $training->load('exercises');

        return view('trainer.trainings.edit', compact('training', 'exercises', 'locked'));
    }

    public function update(Request $request, Training $training)
    {
        $trainer = Auth::user()->trainer;

        if ((int)$training->trainer_id !== (int)$trainer->id) {
            abort(403);
        }

        // Lock: ne dozvoli izmene za prošle treninge
        if (Carbon::parse($training->datum)->lt(Carbon::today())) {
            return back()->with('error', 'Ne možete menjati trening koji je već prošao.');
        }

        $validated = $request->validate([
            'items' => 'nullable|array',

            'items.*.exercise_id' => 'required|exists:exercises,id',

            'items.*.redosled' => 'nullable|integer|min:1|max:500',

            'items.*.broj_serija' => 'required|integer|min:1|max:50',

            'items.*.broj_ponavljanja' => 'required|integer|min:1|max:500',

            'items.*.tezina_kg' => 'nullable|numeric|min:0|max:1000',

            'items.*.odmor_sec' => 'nullable|integer|min:0|max:3600',

            'items.*.napomena' => 'nullable|string|max:1000',
        ]);

        $items = $validated['items'] ?? [];

        // Ako korisnik obriše sve redove => obriši sve pivot veze
        if (count($items) === 0) {
            $training->exercises()->sync([]);
            return redirect()
                ->route('trainer.trainings.edit', $training)
                ->with('success', 'Trening je ažuriran (obrisane su sve vežbe).');
        }

        // Priprema za sync: [exercise_id => pivot_data]
        $syncData = [];

        foreach ($items as $row) {
            $exerciseId = (int)$row['exercise_id'];

            $syncData[$exerciseId] = [
                'redosled' => $row['redosled'] ?? null,
                'broj_serija' => $row['broj_serija'] ?? null,
                'broj_ponavljanja' => $row['broj_ponavljanja'] ?? null,
                'tezina_kg' => $row['tezina_kg'] ?? null,
                'odmor_sec' => $row['odmor_sec'] ?? null,
                'napomena' => $row['napomena'] ?? null,
            ];
        }

        $training->exercises()->sync($syncData);

        return redirect()
            ->route('trainer.trainings.edit', $training)
            ->with('success', 'Trening je uspešno ažuriran.');
    }
}