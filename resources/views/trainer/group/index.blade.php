@extends('trainer.layout')

@section('content')

<style>
.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 25px;
}

.group-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    transition: 0.3s ease;
}

.group-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.6);
}

.training-name {
    color: var(--orange);
    font-weight: 600;
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

.new-btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 10px 20px;
}
</style>

<h3 class="page-title">Moji grupni treninzi</h3>

<a href="{{ route('trainer.group.create') }}"
   class="btn btn-warning new-btn mb-4">
    + Novi grupni trening
</a>

@forelse($trainings as $group)

<div class="card group-card p-4 mb-4">

    <h5 class="training-name">
        {{ $group->naziv }}
    </h5>

    <div class="info-grid">

        <div>
            <div class="label">Datum</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($group->datum)->format('d.m.Y') }}
            </div>
        </div>

        <div>
            <div class="label">Vreme</div>
            <div class="value">
                {{ \Carbon\Carbon::parse($group->vreme_pocetka)->format('H:i') }}
            </div>
        </div>

        <div>
            <div class="label">Trajanje</div>
            <div class="value">
                {{ $group->trajanje_min }} min
            </div>
        </div>

        <div>
            <div class="label">Maksimalan broj učesnika</div>
            <div class="value">
                {{ $group->max_ucesnika }}
            </div>
        </div>

    </div>

</div>

@empty

<div class="alert alert-info shadow-sm">
    Nemate kreiranih grupnih treninga.
</div>

@endforelse

@endsection