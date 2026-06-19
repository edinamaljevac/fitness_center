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

.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 30px;
}

.training-name {
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

.status.approved {
    background-color: #1f3d2b;
    color: #00ff95;
}

.status.rejected {
    background-color: #3d1f1f;
    color: #ff6b6b;
}

.apply-btn {
    border-radius: 12px;
    padding: 10px 22px;
    font-weight: 600;
    transition: 0.3s ease;
}

.apply-btn:hover {
    transform: scale(1.05);
}
</style>

<h3 class="page-title">Grupni treninzi</h3>

@forelse($groups as $group)

@php
    $registration = $registrations[$group->id] ?? null;
@endphp

<div class="card training-card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-start mb-3">
        <h5 class="training-name">
            {{ $group->naziv }}
        </h5>

        @if($registration && $registration->status === 'pending')
            <span class="badge status pending">Na čekanju</span>
        @elseif($registration && $registration->status === 'approved')
            <span class="badge status approved">Potvrđeno</span>
        @elseif($registration && $registration->status === 'rejected')
            <span class="badge status rejected">Odbijeno</span>
        @endif
    </div>

    <div class="info-grid">

        <div>
            <span class="label">Trener</span>
            <div class="value">
                {{ $group->trainer->user->name ?? '-' }}
            </div>
        </div>

        <div>
            <span class="label">Datum</span>
            <div class="value">
                {{ \Carbon\Carbon::parse($group->datum)->format('d.m.Y') }}
            </div>
        </div>

        <div>
            <span class="label">Vreme</span>
            <div class="value">
                {{ \Carbon\Carbon::parse($group->vreme_pocetka)->format('H:i') }}
            </div>
        </div>

        <div>
            <span class="label">Trajanje</span>
            <div class="value">
                {{ $group->trajanje_min }} min
            </div>
        </div>

    </div>

    @if(!$registration)
        <form method="POST"
              action="{{ route('member.group.apply', $group) }}"
              class="mt-4">
            @csrf
            <button class="btn btn-warning apply-btn">
                Prijavi se
            </button>
        </form>
    @endif

</div>

@empty

<div class="alert alert-info shadow-sm">
    Trenutno nema dostupnih grupnih treninga.
</div>

@endforelse

@endsection