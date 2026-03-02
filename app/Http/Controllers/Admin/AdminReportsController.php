<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Membership;
use App\Models\Member;
use App\Models\Attendance;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminReportsController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        /*
        |--------------------------------------------------------------------------
        | PRIHOD
        |--------------------------------------------------------------------------
        */

        $totalRevenue = Payment::sum('iznos');

        $monthlyRevenue = Payment::whereMonth('datum', $today->month)
            ->whereYear('datum', $today->year)
            ->sum('iznos');


        /*
        |--------------------------------------------------------------------------
        | ČLANOVI
        |--------------------------------------------------------------------------
        */

        $activeMembers = Membership::where('aktivno', true)
            ->whereDate('datum_zavrsetka', '>=', $today)
            ->count();

        $membersPerMonth = Member::select(
                DB::raw('MONTH(datum_uclanjenja) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('datum_uclanjenja', $today->year)
            ->groupBy('month')
            ->pluck('total', 'month');


        /*
        |--------------------------------------------------------------------------
        | DOLASCI
        |--------------------------------------------------------------------------
        */

        $totalAttendances = Attendance::count();

        $monthlyAttendances = Attendance::whereMonth('datum', $today->month)
            ->whereYear('datum', $today->year)
            ->count();

        $avgAttendancesPerMember = $activeMembers > 0
            ? $totalAttendances / $activeMembers
            : 0;


        /*
        |--------------------------------------------------------------------------
        | RAD TRENERA
        |--------------------------------------------------------------------------
        */

        $trainersStats = Trainer::withCount('trainings')
            ->withAvg('trainings as avg_rating', 'ocena')
            ->get();


        return view('admin.reports.index', compact(
            'totalRevenue',
            'monthlyRevenue',
            'activeMembers',
            'membersPerMonth',
            'totalAttendances',
            'monthlyAttendances',
            'avgAttendancesPerMember',
            'trainersStats'
        ));
    }
}