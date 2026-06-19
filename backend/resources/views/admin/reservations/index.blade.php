@extends('admin.layout')

@section('content')

<style>
.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 30px;
}

.reservation-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    transition: 0.3s ease;
}

.reservation-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.6);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 25px;
    margin-bottom: 20px;
}

.label {
    font-size: 0.75rem;
    text-transform: uppercase;
    color: #8c8c98;
    letter-spacing: 1px;
}

.value {
    font-size: 1rem;
    font-weight: 600;
    color: #ffffff;
}

.action-btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 8px 18px;
}
</style>

<h3 class="page-title">Personalne rezervacije</h3>

@forelse($reservations as $reservation)

<div class="card reservation-card p-4 mb-4">

    <div class="info-grid">

        <div>
            <div class="label">Član</div>
            <div class="value">
                {{ $reservation->member->user->name }}
            </div>
        </div>

        <div>
            <div class="label">Datum</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($reservation->slot->datum)->format('d.m.Y') }}
            </div>
        </div>

        <div>
            <div class="label">Vreme</div>
            <div class="value">
                {{ $reservation->slot->vreme_pocetka 
                    ? \Carbon\Carbon::parse($reservation->slot->vreme_pocetka)->format('H:i') 
                    : '-' 
                }}
            </div>
        </div>

    </div>

    <div class="d-flex gap-3 flex-wrap">

        <form method="POST"
              action="{{ route('admin.reservations.approve', $reservation) }}">
            @csrf
            @method('PATCH')
            <button class="btn btn-success action-btn">
                ✓ Odobri
            </button>
        </form>

        <form method="POST"
              action="{{ route('admin.reservations.reject', $reservation) }}">
            @csrf
            @method('PATCH')
            <button class="btn btn-danger action-btn">
                ✕ Odbij
            </button>
        </form>

    </div>

</div>

@empty

<div class="alert alert-info shadow-sm">
    Trenutno nema rezervacija.
</div>

@endforelse

@endsection