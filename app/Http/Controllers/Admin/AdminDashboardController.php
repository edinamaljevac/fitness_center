<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Trainer;
use App\Models\Package;
use App\Models\SlotReservation;
use App\Models\Registration;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'membersCount' => Member::count(),
            'trainersCount' => Trainer::count(),
            'packagesCount' => Package::count(),
            'totalTrainings' => Training::count(),
            'averageRating' => Training::whereNotNull('ocena')->avg('ocena')
        ]);
    }

    public function reservations()
{
    $reservations = SlotReservation::with(['member','slot'])
        ->where('status','pending')
        ->get();

    return view('admin.reservations.index', compact('reservations'));
}


public function groupRegistrations()
{
    $registrations = Registration::with(['member','groupTraining'])
        ->where('status','pending')
        ->get();

    return view('admin.group-registrations.index', compact('registrations'));
}

    
}


