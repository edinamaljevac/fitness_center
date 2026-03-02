@extends('trainer.layout')

@section('content')

<style>
.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 25px;
}

.slot-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    transition: 0.3s ease;
}

.slot-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.6);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 25px;
    margin-top: 15px;
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

.status {
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.8rem;
}

.status.open {
    background-color: #1f3d2b;
    color: #00ff95;
}

.status.closed {
    background-color: #3d1f1f;
    color: #ff6b6b;
}

.new-btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 10px 20px;
}
</style>

<h3 class="page-title">Moji personalni termini</h3>

<a href="{{ route('trainer.slots.create') }}"
   class="btn btn-warning new-btn mb-4">
    + Novi termin
</a>

@forelse($slots as $slot)

<div class="card slot-card p-4 mb-4">

    <h5 style="color: var(--orange);">
        {{ \Carbon\Carbon::parse($slot->datum)->format('d.m.Y') }}
    </h5>

    <div class="info-grid">

        <div>
            <div class="label">Vreme</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($slot->vreme_pocetka)->format('H:i') }}
            </div>
        </div>

        <div>
            <div class="label">Status</div>
            <div>
                @if($slot->status == 'open')
                    <span class="status open">Otvoren</span>
                @else
                    <span class="status closed">Zatvoren</span>
                @endif
            </div>
        </div>

    </div>

</div>

@empty

<div class="alert alert-info shadow-sm">
    Nemate kreiranih termina.
</div>

@endforelse

@endsection