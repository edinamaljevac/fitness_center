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

.details-btn {
    border-radius: 12px;
    padding: 8px 18px;
    font-weight: 600;
}

.rating {
    display: flex;
    flex-direction: row-reverse;
    gap: 4px;
}

.rating input {
    display: none;
}

.rating label {
    font-size: 22px;
    color: #444;
    cursor: pointer;
    transition: 0.2s;
}

.rating label:hover,
.rating label:hover ~ label {
    color: #ffc107;
}

.rating input:checked ~ label {
    color: #ffc107;
}
.badge-rated {
    background-color: #1f3d2b;
    color: #00ff95;
    padding: 6px 14px;
    border-radius: 20px;
    font-weight: 600;
}
</style>

<h3 class="page-title">Moji treninzi</h3>

@if($trainings->isEmpty())
    <div class="alert alert-info shadow-sm">
        Nemate nijedan potvrđen trening.
    </div>
@endif

@foreach($trainings as $training)

@php
    $trainingDateTime = \Carbon\Carbon::parse($training->datum)
        ->setTimeFromTimeString($training->vreme_pocetka);
@endphp

<div class="card training-card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-start mb-3">
        <h5 style="color: var(--orange);">
            {{ \Carbon\Carbon::parse($training->datum)->format('d.m.Y') }}
        </h5>

        @if($training->ocena)
            <span class="badge-rated">
                Ocenjeno: {{ $training->ocena }}/5
            </span>
        @endif
    </div>

    <div class="info-grid">

        <div>
            <span class="label">Tip</span>
            <div class="value">
                {{ $training->tip === 'group' ? 'Grupni trening' : 'Personalni trening' }}
            </div>
        </div>

        <div>
            <span class="label">Trener</span>
            <div class="value">
                {{ $training->trainer->user->name ?? '-' }}
            </div>
        </div>

        <div>
            <span class="label">Vreme</span>
            <div class="value">
                {{ \Carbon\Carbon::parse($training->vreme_pocetka)->format('H:i') }}
            </div>
        </div>

        <div>
            <span class="label">Trajanje</span>
            <div class="value">
                {{ $training->trajanje_min }} min
            </div>
        </div>

    </div>

    <div class="mt-4 d-flex gap-3 align-items-center flex-wrap">

        <a href="{{ route('member.trainings.show', $training) }}"
           class="btn btn-outline-warning details-btn">
            Detalji
        </a>

        @if(!$training->ocena && $trainingDateTime->isPast())

            <form method="POST"
                  action="{{ route('member.trainings.rate', $training) }}"
                  class="rating-wrapper d-flex align-items-center gap-2">

                @csrf
                @method('PATCH')

                <div class="rating">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="ocena"
                               value="{{ $i }}"
                               id="star{{ $training->id }}_{{ $i }}">
                        <label for="star{{ $training->id }}_{{ $i }}">★</label>
                    @endfor
                </div>

                <button class="btn btn-warning btn-sm">
                    Oceni
                </button>

            </form>

        @elseif(!$training->ocena && !$trainingDateTime->isPast())

            <span class="badge bg-secondary">
                Možete oceniti nakon treninga
            </span>

        @endif

    </div>

</div>

@endforeach

@endsection