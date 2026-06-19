<?php

namespace App\Http\Controllers;

use App\Models\GroupTraining;
use App\Models\Registration;
use App\Services\GroupRegistrationService;
use Illuminate\Support\Facades\Auth;

class GroupRegistrationController extends Controller
{
    protected $service;

    public function __construct(GroupRegistrationService $service)
    {
        $this->service = $service;
    }

    public function store(GroupTraining $group)
    {
        try {
            $member = Auth::user()->member;

            $this->service->createRegistration($group, $member);

            return back()->with('success', 'Zahtev je poslat.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function approve(Registration $registration)
    {
        try {
            $this->service->approveRegistration($registration);

            return back()->with('success', 'Prijava odobrena.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject(Registration $registration)
    {
        try {
            $this->service->rejectRegistration($registration);

            return back()->with('success', 'Prijava odbijena.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
