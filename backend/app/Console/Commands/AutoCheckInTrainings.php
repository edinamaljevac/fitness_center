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

        $trainings = Training::whereDate('datum', $now->toDateString())
            ->where('zavrsen', false)
            ->get();

        foreach ($trainings as $training) {

            $start = Carbon::parse($training->datum)
                ->setTimeFromTimeString($training->vreme_pocetka);

            $end = $start->copy()->addMinutes($training->trajanje_min);

            if ($now->greaterThanOrEqualTo($start)) {

                $attendance = Attendance::where('member_id', $training->member_id)
                    ->where('datum', $training->datum)
                    ->where('vreme_ulaska', $training->vreme_pocetka)
                    ->first();

                if (!$attendance) {
                    $attendance = Attendance::create([
                        'member_id'     => $training->member_id,
                        'datum'         => $training->datum,
                        'vreme_ulaska'  => $training->vreme_pocetka,
                        'vreme_izlaska' => null,
                    ]);
                }

                if ($now->greaterThanOrEqualTo($end)) {

                    if (is_null($attendance->vreme_izlaska)) {
                        $attendance->update([
                            'vreme_izlaska' => $end->format('H:i:s'),
                        ]);
                    }

                    $training->update([
                        'zavrsen' => true
                    ]);
                }
            }
        }

        return 0;

    } catch (\Throwable $e) {

        \Illuminate\Support\Facades\Log::error('Auto check-in error: ' . $e->getMessage());

        return 1;
    }
}
}