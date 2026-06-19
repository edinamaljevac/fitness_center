<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with([
                'membership.member.user',
                'membership.package'
            ])
            ->when($request->search, function ($query, $search) {
                $query->whereHas('membership.member.user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderByDesc('datum')
            ->get();

        return response()->json([
            'message' => 'Lista uplata je uspješno učitana.',
            'data' => $payments
        ]);
    }

    public function activeMemberships()
    {
        $memberships = Membership::with(['member.user', 'package'])
            ->where('aktivno', true)
            ->get();

        return response()->json([
            'message' => 'Aktivna članstva su uspješno učitana.',
            'data' => $memberships
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'membership_id' => ['required', 'exists:memberships,id'],
            'iznos' => ['required', 'numeric', 'min:0.01'],
            'nacin_placanja' => ['required', 'string', 'max:100'],
            'broj_racuna' => ['nullable', 'string', 'max:100'],
            'napomena' => ['nullable', 'string', 'max:1000'],
        ]);

        $membership = Membership::findOrFail($validated['membership_id']);

        $payment = Payment::create([
            'membership_id' => $membership->id,
            'datum' => now(),
            'iznos' => $validated['iznos'],
            'nacin_placanja' => $validated['nacin_placanja'],
            'status' => 'uspešno',
            'broj_racuna' => $validated['broj_racuna'] ?? null,
            'napomena' => $validated['napomena'] ?? null,
        ]);

        if (! $membership->aktivno) {
            $membership->update([
                'aktivno' => true
            ]);
        }

        $payment->load([
            'membership.member.user',
            'membership.package'
        ]);

        return response()->json([
            'message' => 'Uplata je uspješno evidentirana.',
            'data' => $payment
        ], 201);
    }

    public function show(Payment $payment)
    {
        $payment->load([
            'membership.member.user',
            'membership.package'
        ]);

        return response()->json([
            'message' => 'Detalji uplate su uspješno učitani.',
            'data' => $payment
        ]);
    }
}