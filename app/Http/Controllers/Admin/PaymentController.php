<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Membership;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['membership.member.user'])
            ->orderByDesc('datum')
            ->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $memberships = Membership::with(['member.user', 'package'])
            ->where('aktivno', true)
            ->get();

        return view('admin.payments.create', compact('memberships'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'membership_id' => 'required|exists:memberships,id',
            'iznos' => 'required|numeric|min:0.01',
            'nacin_placanja' => 'required|string',
            'broj_racuna' => 'nullable|string',
            'napomena' => 'nullable|string',
        ]);

        $membership = Membership::findOrFail($request->membership_id);

        Payment::create([
            'membership_id' => $membership->id,
            'datum' => now(),
            'iznos' => $request->iznos,
            'nacin_placanja' => $request->nacin_placanja,
            'status' => 'uspešno',
            'broj_racuna' => $request->broj_racuna,
            'napomena' => $request->napomena,
        ]);

        // ⭐ osiguravamo da je članstvo aktivno
        if (! $membership->aktivno) {
            $membership->update(['aktivno' => true]);
        }

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Uplata je uspešno evidentirana.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['membership.member.user', 'membership.package']);

        return view('admin.payments.show', compact('payment'));
    }
}
