@extends('member.layout')

@section('content')

<style>
.details-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
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

.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 25px;
}

.table thead {
    color: var(--orange);
}
</style>

<h2 class="page-title">Detalji treninga</h2>

<div class="card details-card p-4 mb-4">
    <div class="row g-4">

        <div class="col-md-2">
            <div class="label">Datum</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($training->datum)->format('d.m.Y') }}
            </div>
        </div>

        <div class="col-md-2">
            <div class="label">Vreme</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($training->vreme_pocetka)->format('H:i') }}
            </div>
        </div>

        <div class="col-md-2">
            <div class="label">Trajanje</div>
            <div class="value">
                {{ $training->trajanje_min }} min
            </div>
        </div>

        <div class="col-md-3">
            <div class="label">Trener</div>
            <div class="value">
                {{ $training->trainer?->user?->name ?? '—' }}
            </div>
        </div>

        <div class="col-md-2">
            <div class="label">Ocena</div>
            <div class="value">
                {{ $training->ocena ?? '—' }}
            </div>
        </div>

    </div>
</div>

<div class="card details-card p-4">

    <h5 class="mb-4" style="color: var(--orange);">
        Vežbe
    </h5>

    @if($training->exercises->isEmpty())
        <div class="alert alert-info mb-0">
            Trener još uvek nije uneo vežbe za ovaj trening.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Vežba</th>
                        <th>Serije</th>
                        <th>Ponavljanja</th>
                        <th>Težina (kg)</th>
                        <th>Odmor (sec)</th>
                        <th>Napomena</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($training->exercises as $ex)
                        <tr>
                            <td>{{ $ex->pivot->redosled ?? $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $ex->naziv }}</td>
                            <td>{{ $ex->pivot->broj_serija ?? '—' }}</td>
                            <td>{{ $ex->pivot->broj_ponavljanja ?? '—' }}</td>
                            <td>{{ $ex->pivot->tezina_kg ?? '—' }}</td>
                            <td>{{ $ex->pivot->odmor_sec ?? '—' }}</td>
                            <td class="text-muted">{{ $ex->pivot->napomena ?? '—' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('member.trainings.index') }}"
           class="btn btn-outline-light">
            Nazad
        </a>
    </div>

</div>

@endsection