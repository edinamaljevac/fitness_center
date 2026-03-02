<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function index(Request $request)
    {
        $query = Exercise::query();

        // Opcioni filteri
        if ($request->filled('kategorija')) {
            $query->where('kategorija', 'like', '%' . $request->kategorija . '%');
        }

        if ($request->filled('misicna_grupa')) {
            $query->where('misicna_grupa', 'like', '%' . $request->misicna_grupa . '%');
        }

        if ($request->filled('oprema')) {
            $query->where('oprema', 'like', '%' . $request->oprema . '%');
        }

        if ($request->filled('q')) {
            $query->where('naziv', 'like', '%' . $request->q . '%');
        }

        $exercises = $query->orderBy('naziv')->paginate(15)->withQueryString();

        return view('admin.exercises.index', compact('exercises'));
    }

    public function create()
    {
        return view('admin.exercises.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'naziv' => 'required|string|max:255|unique:exercises,naziv',
            'kategorija' => 'nullable|string|max:255',
            'opis' => 'nullable|string',
            'oprema' => 'nullable|string|max:255',
            'misicna_grupa' => 'nullable|string|max:255',
        ]);

        Exercise::create($validated);

        return redirect()
            ->route('admin.exercises.index')
            ->with('success', 'Vežba je uspešno dodata.');
    }

    public function edit(Exercise $exercise)
    {
        return view('admin.exercises.edit', compact('exercise'));
    }

    public function update(Request $request, Exercise $exercise)
    {
        $validated = $request->validate([
            'naziv' => 'required|string|max:255|unique:exercises,naziv,' . $exercise->id,
            'kategorija' => 'nullable|string|max:255',
            'opis' => 'nullable|string',
            'oprema' => 'nullable|string|max:255',
            'misicna_grupa' => 'nullable|string|max:255',
        ]);

        $exercise->update($validated);

        return redirect()
            ->route('admin.exercises.index')
            ->with('success', 'Vežba je uspešno izmenjena.');
    }

    public function destroy(Exercise $exercise)
    {
        // Ako je vežba već korišćena u treninzima, pivot bi mogao da blokira brisanje.
        // U tom slučaju umesto delete možeš "soft delete" ili detach.
        // Za sada: detach pa delete (sigurno).
        $exercise->trainings()->detach();
        $exercise->delete();

        return back()->with('success', 'Vežba je obrisana.');
    }
}