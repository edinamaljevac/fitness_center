<?php

namespace App\Http\Controllers;

use App\Models\TrainingSlot;
use App\Models\SlotReservation;
use App\Services\SlotReservationService;
use Illuminate\Support\Facades\Auth;

class SlotReservationController extends Controller
{
    protected $service;

    public function __construct(SlotReservationService $service)
    {
        $this->service = $service;
    }

    public function store(TrainingSlot $slot)
    {
        try {
            $member = Auth::user()->member;

            $this->service->createReservation($slot, $member);

            return back()->with('success', 'Zahtev je poslat.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function approve(SlotReservation $reservation)
    {
        try {
            $this->service->approveReservation($reservation);
            return back()->with('success', 'Rezervacija odobrena.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject(SlotReservation $reservation)
    {
        try {
            $this->service->rejectReservation($reservation);
            return back()->with('success', 'Rezervacija odbijena.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function cancel(SlotReservation $reservation)
    {
        try {
            $this->service->cancelReservation($reservation);
            return back()->with('success', 'Rezervacija otkazana.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
