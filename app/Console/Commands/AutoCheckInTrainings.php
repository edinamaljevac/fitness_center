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
        try {

            $now = Carbon::now();

            $trainings = Training::whereDate('datum', $now->toDateString())->get();

            foreach ($trainings as $training) {

                $start = Carbon::parse($training->datum . ' ' . $training->vreme_pocetka);
                $end   = $start->copy()->addMinutes($training->trajanje_min);

                // CHECK-IN
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
                    }
                }

                // CHECK-OUT + CLOSE
                if ($now->greaterThanOrEqualTo($end) && !$training->zavrsen) {

                    $attendance = Attendance::where('member_id', $training->member_id)
                        ->whereDate('datum', $training->datum)
                        ->first();

                    if ($attendance && is_null($attendance->vreme_izlaska)) {
                        $attendance->update([
                            'vreme_izlaska' => $end->format('H:i:s'),
                        ]);
                    }

                    $training->update([
                        'zavrsen' => true
                    ]);
                }
            }

            return 0;

        } catch (\Throwable $e) {

            \Illuminate\Support\Facades\Log::error('Auto check-in error: ' . $e->getMessage());

            return 1;
        }
    }
}