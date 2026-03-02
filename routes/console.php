<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('trainings:auto-checkin')
    ->everyMinute()
    ->withoutOverlapping()
    ->onOneServer()
    ->runInBackground()
    ->before(function () {
        \Illuminate\Support\Facades\Log::info('Auto check-in scheduler pokrenut');
    })
    ->onFailure(function () {
        \Illuminate\Support\Facades\Log::error('Auto check-in scheduler pao');
    });