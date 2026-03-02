<?php

namespace App\Services;

use App\Models\TrainingSlot;
use App\Models\SlotReservation;
use App\Models\Training;
use App\Models\Membership;

class SlotReservationService
{
    private function getValidTPackageMembershipForDate(int $memberId, $date): ?Membership
    {
        $slotDate = \Carbon\Carbon::parse($date)->toDateString();

        return Membership::where('member_id', $memberId)
            ->where('aktivno', true)
            ->whereDate('datum_pocetka', '<=', $slotDate)      
            ->whereDate('datum_zavrsetka', '>=', $slotDate)   
            ->whereHas('package', function ($q) {
                $q->where('tip', 'T');
            })
            ->orderByDesc('datum_pocetka')
            ->first();
    }

   
    public function createReservation(TrainingSlot $slot, $member): SlotReservation
    {
        $membership = $this->getValidTPackageMembershipForDate($member->id, $slot->datum);

        if (!$membership) {
            throw new \Exception('Nemate aktivan paket za personalne treninge.');
        }

        if (is_null($membership->preostalo_treninga) || $membership->preostalo_treninga <= 0) {
            throw new \Exception('Nemate preostalih treninga u paketu.');
        }

        if ($slot->status !== 'open') {
            throw new \Exception('Termin nije dostupan.');
        }

        if ($slot->reservations()
            ->where('member_id', $member->id)
            ->exists()
        ) {
            throw new \Exception('Već ste poslali zahtev.');
        }

        return SlotReservation::create([
            'training_slot_id' => $slot->id,
            'member_id'        => $member->id,
            'status'           => 'pending'
        ]);
    }

    public function approveReservation(SlotReservation $reservation): void
    {
        $slot = $reservation->slot;

        if (!$slot || $slot->status !== 'open') {
            throw new \Exception('Termin više nije dostupan.');
        }

        if ($reservation->status !== 'pending') {
            throw new \Exception('Ova rezervacija više nije na čekanju.');
        }

        $membership = $this->getValidTPackageMembershipForDate($reservation->member_id, $slot->datum);

        if (!$membership) {
            throw new \Exception('Član nema aktivan paket za personalne treninge.');
        }

        if (is_null($membership->preostalo_treninga) || $membership->preostalo_treninga <= 0) {
            throw new \Exception('Član nema preostalih treninga u paketu.');
        }

        $reservation->update([
            'status' => 'approved'
        ]);

        Training::create([
            'member_id'     => $reservation->member_id,
            'trainer_id'    => $slot->trainer_id,
            'datum'         => $slot->datum,
            'vreme_pocetka' => $slot->vreme_pocetka,
            'trajanje_min'  => $slot->trajanje_min,
            'tip'           => $slot->tip,
            'napomena'      => 'Kreirano iz rezervacije termina',
            'ocena'         => null
        ]);

        $membership->decrement('preostalo_treninga');

        $membership->refresh();

        if ((int)$membership->preostalo_treninga <= 0) {
            $membership->update(['aktivno' => false]);
        }

        $approvedCount = $slot->reservations()
            ->where('status', 'approved')
            ->count();

        if ($approvedCount >= $slot->max_clanova) {
            $slot->update(['status' => 'closed']);
        }
    }

   
    public function rejectReservation(SlotReservation $reservation): void
    {
        if ($reservation->status !== 'pending') {
            throw new \Exception('Možete odbiti samo rezervacije na čekanju.');
        }

        $reservation->update([
            'status' => 'rejected'
        ]);
    }

    
    public function cancelReservation(SlotReservation $reservation): void
    {
        if ($reservation->status !== 'pending') {
            throw new \Exception('Ne možete otkazati ovu rezervaciju.');
        }

        $reservation->delete();
    }
}