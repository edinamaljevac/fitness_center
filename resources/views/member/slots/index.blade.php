@extends('member.layout')

@section('content')

<style>
.training-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    transition: 0.3s ease;
}

.training-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.6);
}

.date {
    color: var(--orange);
    font-weight: 600;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 25px;
    margin-top: 10px;
}

.label {
    font-size: 0.75rem;
    text-transform: uppercase;
    color: #8c8c98;
    letter-spacing: 1px;
}

.value {
    font-size: 1rem;
    font-weight: 500;
    color: #ffffff;
}

.status {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.status.pending {
    background-color: #3a3a44;
    color: #ffc107;
}

.reserve-btn {
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
    transition: 0.3s ease;
}

.reserve-btn:hover {
    transform: scale(1.05);
}

.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 30px;
}
</style>

<h3 class="page-title">Personalni treninzi</h3>

@php
$visibleSlots = collect($slots)->filter(function($slot) use ($reservations) {
    $reservation = $reservations[$slot->id] ?? null;

    return !(
        ($reservation && in_array($reservation->status, ['approved', 'rejected']))
        || (!$reservation && $slot->status === 'closed')
    );
});
@endphp

@forelse($visibleSlots as $slot)

@php
    $reservation = $reservations[$slot->id] ?? null;
@endphp

<div class="card training-card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-start mb-3">
        <h5 class="date">
            {{ \Carbon\Carbon::parse($slot->datum)->format('d.m.Y') }}
        </h5>

        @if($reservation && $reservation->status === 'pending')
            <span class="badge status pending">Na čekanju</span>
        @endif
    </div>

    <div class="info-grid">

        <div>
            <span class="label">Trener</span>
            <div class="value">
                {{ $slot->trainer->user->name ?? '-' }}
            </div>
        </div>

        <div>
            <span class="label">Vreme</span>
            <div class="value">
                {{ \Carbon\Carbon::parse($slot->vreme_pocetka)->format('H:i') }}
            </div>
        </div>

        <div>
            <span class="label">Trajanje</span>
            <div class="value">
                {{ $slot->trajanje_min }} min
            </div>
        </div>

    </div>

    @if(!$reservation && $slot->status === 'open')
        <form method="POST"
              action="{{ route('member.slots.reserve', $slot) }}"
              class="mt-4">
            @csrf
            <button class="btn btn-warning reserve-btn">
                Pošalji zahtev
            </button>
        </form>
    @endif

</div>

@empty

<div class="alert alert-info shadow-sm">
    Trenutno nema dostupnih personalnih termina.
</div>

@endforelse

@endsection