@extends('trainer.layout')

@section('content')

<h2 class="mb-4 fw-bold" style="color: var(--orange);">
    Trainer Dashboard
</h2>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="text-white fw-semibold mb-2">Aktivni klijenti</p>
            <h2 class="fw-bold text-white display-6">
                {{ $activeClients }}
            </h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="text-white fw-semibold mb-2">Današnji treninzi</p>
            <h2 class="fw-bold text-white display-6">
                {{ $todayTrainings }}
            </h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="text-white fw-semibold mb-2">Ove nedelje</p>
            <h2 class="fw-bold text-white display-6">
                {{ $weekTrainings }}
            </h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="text-white fw-semibold mb-2">Prosečna ocena</p>
            <h2 class="fw-bold text-warning display-6">
                {{ $averageRating ? number_format($averageRating, 2) : 'Nema ocena' }}
            </h2>
        </div>
    </div>

</div>

{{-- Sledeći trening --}}
<div class="card p-4 mt-4">

    <h5 class="mb-3 text-warning fw-bold">Sledeći trening</h5>

    @if($nextTraining)
        <p class="text-white mb-2">
            <strong>Datum:</strong>
            {{ \Carbon\Carbon::parse($nextTraining->datum)->format('d.m.Y') }}
        </p>

        <p class="text-white mb-2">
            <strong>Vreme:</strong>
            {{ \Carbon\Carbon::parse($nextTraining->vreme_pocetka)->format('H:i') }}
        </p>

        <p class="text-white mb-0">
            <strong>Trajanje:</strong>
            {{ $nextTraining->trajanje_min }} min
        </p>
    @else
        <p class="text-white mb-0">Nema planiranih treninga.</p>
    @endif

</div>

@endsection