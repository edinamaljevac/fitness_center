<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;
use Carbon\Carbon;

class TrainerDashboardController extends Controller
{
    public function index()
    {
        $trainer = Auth::user()->trainer;

        // Bazni query
        $baseQuery = Training::where('trainer_id', $trainer->id);

        // Aktivni klijenti
        $activeClients = (clone $baseQuery)
            ->distinct('member_id')
            ->count('member_id');

        // Današnji treninzi
        $todayTrainings = (clone $baseQuery)
            ->whereDate('datum', Carbon::today())
            ->count();

        // Treninzi ove nedelje
        $weekTrainings = (clone $baseQuery)
            ->whereBetween('datum', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();

        $now = Carbon::now();
        // Sledeći trening
        $nextTraining = (clone $baseQuery)
            ->get()
            ->filter(function ($training) use ($now) {
                $dateTime = Carbon::parse($training->datum)
                    ->setTimeFromTimeString($training->vreme_pocetka);

                return $dateTime->isFuture();
            })
            ->sortBy(function ($training) {
                return Carbon::parse($training->datum)
                    ->setTimeFromTimeString($training->vreme_pocetka);
            })
            ->first();
            
        // Prosečna ocena
        $averageRating = (clone $baseQuery)
            ->whereNotNull('ocena')
            ->avg('ocena');

        return view('trainer.dashboard', compact(
            'trainer',
            'activeClients',
            'todayTrainings',
            'weekTrainings',
            'nextTraining',
            'averageRating'
        ));
    }
}