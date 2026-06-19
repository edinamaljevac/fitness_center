@extends('admin.layout')

@section('content')

<h2 class="mb-4 fw-bold" style="color: var(--orange);">
    Admin Dashboard
</h2>

<p class="text-muted mb-5">
    Pregled ključnih informacija sistema fitnes centra
</p>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="card-title mb-2">Članovi</p>
                    <h1 class="fw-bold" style="color: var(--orange);">
                        {{ $membersCount }}
                    </h1>
                </div>
            </div>
            <small class="text-muted">
                Ukupan broj registrovanih članova
            </small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="card-title mb-2">Treneri</p>
                    <h1 class="fw-bold text-white">
                        {{ $trainersCount }}
                    </h1>
                </div>
            </div>
            <small class="text-muted">
                Aktivni treneri u sistemu
            </small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="card-title mb-2">Paketi</p>
                    <h1 class="fw-bold" style="color: var(--orange-soft);">
                        {{ $packagesCount }}
                    </h1>
                </div>

            </div>
            <small class="text-muted">
                Dostupni fitnes paketi
            </small>
        </div>
    </div>

</div>

<div class="row mt-5 g-4">

        <div class="col-12">
            <div class="card p-4">
                <h5 class="fw-bold mb-3" style="color: var(--orange);">
                    Sistem status
                </h5>
                <p class="text-muted mb-0">
                    Svi servisi rade normalno. Sistem je spreman za rad sa članovima,
                    treninzima i uplatama.
                </p>
            </div>
        </div>

    <div class="col-12">
        <div class="card p-4">
            <h5 class="fw-bold mb-3" style="color: var(--orange);">
                Ukupno treninga
            </h5>

            <h2 class="fw-bold text-white mb-2">
                {{ $totalTrainings }}
            </h2>

            <p class="text-muted mb-0">
                Ukupan broj realizovanih treninga u sistemu.
            </p>
        </div>
    </div>

    <div class="col-12">
        <div class="card p-4">
            <h5 class="fw-bold mb-3" style="color: var(--orange);">
                Prosečna ocena sistema
            </h5>

            <h2 class="fw-bold text-white mb-2">
                {{ number_format($averageRating, 2) }}
            </h2>

            <p class="text-muted mb-0">
                Prosečna ocena svih treninga koje su članovi ocenili.
            </p>
        </div>
    </div>

</div>


@endsection
