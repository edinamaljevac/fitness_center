<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Training;
use App\Models\Attendance;
use Carbon\Carbon;

class AutoCheckInTrainings extends Command
{
    protected $signature = 'trainings:auto-checkin';

    protected $description = 'Automatski check-in i zatvaranje treninga';

    public function handle()
    {
        $now = Carbon::now();

        // Uzimamo samo današnje treninge
        $trainings = Training::whereDate('datum', $now->toDateString())
            ->get();

        foreach ($trainings as $training) {

            $start = $training->datum
                ->copy()
                ->setTimeFromTimeString($training->vreme_pocetka);

            $end = $start->copy()
                ->addMinutes($training->trajanje_min);

            /*
            |--------------------------------------------------------------------------
            | 1️⃣ AUTOMATSKI CHECK-IN
            |--------------------------------------------------------------------------
            */
            if ($now->greaterThanOrEqualTo($start)) {

                $already = Attendance::where('member_id', $training->member_id)
                    ->whereDate('datum', $training->datum)
                    ->exists();

                if (!$already) {

                    Attendance::create([
                        'member_id'     => $training->member_id,
                        'datum'         => $training->datum,
                        'vreme_ulaska'  => $training->vreme_pocetka,
                        'vreme_izlaska' => null,
                    ]);

                    $this->info('Check-in dodat za trening ID: ' . $training->id);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 2️⃣ AUTOMATSKI CHECK-OUT + ZATVARANJE
            |--------------------------------------------------------------------------
            */
            if ($now->greaterThanOrEqualTo($end) && !$training->zavrsen) {

                $attendance = Attendance::where('member_id', $training->member_id)
                    ->whereDate('datum', $training->datum)
                    ->first();

                if ($attendance && is_null($attendance->vreme_izlaska)) {

                    $attendance->update([
                        'vreme_izlaska' => $end->format('H:i:s'),
                    ]);

                    $this->info('Check-out dodat za trening ID: ' . $training->id);
                }

                $training->update([
                    'zavrsen' => true
                ]);

                $this->info('Trening zatvoren ID: ' . $training->id);
            }
        }

        return 0;
    }
}