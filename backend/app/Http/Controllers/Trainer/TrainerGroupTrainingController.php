<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\GroupTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TrainerGroupTrainingController extends Controller
{
    public function index()
    {
        $trainer = Auth::user()->trainer;

        $trainings = GroupTraining::where('trainer_id', $trainer->id)
            ->orderBy('datum')
            ->orderBy('vreme_pocetka')
            ->get();

        return view('trainer.group.index', compact('trainings'));
    }

    public function create()
    {
        return view('trainer.group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|string|max:255',
            'dan_u_nedelji' => 'required|string',
            'vreme_pocetka' => 'required',
            'trajanje_min' => 'required|integer|min:1',
            'max_ucesnika' => 'required|integer|min:1'
        ]);

        $trainer = Auth::user()->trainer;

        $days = [
            'Ponedeljak' => Carbon::MONDAY,
            'Utorak' => Carbon::TUESDAY,
            'Sreda' => Carbon::WEDNESDAY,
            'Četvrtak' => Carbon::THURSDAY,
            'Petak' => Carbon::FRIDAY,
            'Subota' => Carbon::SATURDAY,
            'Nedelja' => Carbon::SUNDAY,
        ];

        $targetDay = $days[$request->dan_u_nedelji];

        $today = Carbon::today();

        $datum = $today->copy()->next($targetDay);

        if ($today->dayOfWeek == $targetDay) {
            $datum = $today->copy()->addWeek();
        }

        $startDateTime = Carbon::parse(
            $datum->format('Y-m-d') . ' ' . $request->vreme_pocetka
        );

        if ($startDateTime->isPast()) {
            return back()
                ->withInput()
                ->with('error', 'Ne možete kreirati trening u prošlosti.');
        }

        GroupTraining::create([
            'naziv' => $request->naziv,
            'dan_u_nedelji' => $request->dan_u_nedelji,
            'datum' => $datum,
            'vreme_pocetka' => $request->vreme_pocetka,
            'trajanje_min' => $request->trajanje_min,
            'max_ucesnika' => $request->max_ucesnika,
            'opis' => $request->opis,
            'trainer_id' => $trainer->id
        ]);

        return redirect()
            ->route('trainer.group.index')
            ->with('success', 'Grupni trening je kreiran za ' . $datum->format('d.m.Y'));
    }
}