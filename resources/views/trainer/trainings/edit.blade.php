@extends('trainer.layout')

@section('content')
<h2 class="fw-bold mb-3" style="color: var(--orange);">
    Trening: {{ \Carbon\Carbon::parse($training->datum)->format('d.m.Y') }}
    u {{ \Carbon\Carbon::parse($training->vreme_pocetka)->format('H:i') }}
</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card p-4"
     id="trainingCard"
     data-locked="{{ $locked ? '1' : '0' }}"
     style="background-color: var(--dark-gray); border-radius: 15px;">

    @if($locked)
        <div class="alert alert-warning">
            Ovaj trening je prošao i ne može se menjati.
        </div>
    @endif

    <form method="POST" action="{{ route('trainer.trainings.update', $training) }}">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0" style="color: var(--light-gray);">
                Vežbe u treningu
            </h5>

            <button type="button"
                    class="btn btn-outline-light"
                    id="addRowBtn"
                    {{ $locked ? 'disabled' : '' }}>
                + Dodaj vežbu
            </button>
        </div>

        <div id="rowsWrap" class="d-flex flex-column gap-3">

            @php
                $existing = $training->exercises->map(function($ex) {
                    return [
                        'exercise_id' => $ex->id,
                        'redosled' => $ex->pivot->redosled,
                        'broj_serija' => $ex->pivot->broj_serija,
                        'broj_ponavljanja' => $ex->pivot->broj_ponavljanja,
                        'tezina_kg' => $ex->pivot->tezina_kg,
                        'odmor_sec' => $ex->pivot->odmor_sec,
                        'napomena' => $ex->pivot->napomena,
                    ];
                })->values();
            @endphp

            @foreach($existing as $i => $row)
                @include('trainer.trainings.partials.exercise-row', [
                    'i' => $i,
                    'row' => $row,
                    'exercises' => $exercises,
                    'locked' => $locked
                ])
            @endforeach

        </div>

        <div class="d-flex gap-2 mt-4">
            <button class="btn btn-warning px-4"
                    {{ $locked ? 'disabled' : '' }}>
                Sačuvaj
            </button>

            <a href="{{ route('trainer.trainings.index') }}"
               class="btn btn-outline-light px-4">
                Nazad
            </a>
        </div>
    </form>
</div>

{{-- Template row --}}
<template id="rowTemplate">
    @include('trainer.trainings.partials.exercise-row', [
        'i' => '__INDEX__',
        'row' => null,
        'exercises' => $exercises,
        'locked' => $locked
    ])
</template>

<script>
(function () {

    const card = document.getElementById('trainingCard');
    const locked = card.dataset.locked === '1';

    if (locked) return;

    const rowsWrap = document.getElementById('rowsWrap');
    const addBtn = document.getElementById('addRowBtn');
    const tpl = document.getElementById('rowTemplate').innerHTML;

    const getNextIndex = () => {
        const items = rowsWrap.querySelectorAll('[data-row]');
        return items.length;
    };

    addBtn.addEventListener('click', () => {
        const idx = getNextIndex();
        rowsWrap.insertAdjacentHTML('beforeend', tpl.replaceAll('__INDEX__', idx));
    });

    rowsWrap.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-remove]');
        if (!btn) return;

        const row = btn.closest('[data-row]');
        if (row) row.remove();

        const rows = rowsWrap.querySelectorAll('[data-row]');
        rows.forEach((r, newIndex) => {
            r.querySelectorAll('[data-name]').forEach((el) => {
                el.name = el.getAttribute('data-name')
                    .replaceAll('__INDEX__', newIndex);
            });
        });
    });

})();
</script>
@endsection