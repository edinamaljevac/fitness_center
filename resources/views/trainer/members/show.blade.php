@extends('trainer.layout')

@section('content')

<style>
.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 25px;
}

.progress-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    transition: 0.3s ease;
}

.progress-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.6);
}

.measure-date {
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
    font-size: 1.1rem;
    font-weight: 600;
    color: #ffffff;
}

.note-box {
    margin-top: 20px;
    padding: 18px;
    border-radius: 14px;
    background: rgba(255, 140, 0, 0.05);
    border-left: 4px solid var(--orange);
}

.note-title {
    color: var(--orange);
    font-weight: 600;
    margin-bottom: 5px;
}
</style>

<h3 class="page-title">
    Napredak člana {{ $member->user->name }}
</h3>

<a href="{{ route('trainer.members.index') }}"
   class="btn btn-outline-light mb-4">
    ← Nazad
</a>

@forelse($progresses as $progress)

<div class="card progress-card p-4 mb-4">

    <h5 class="measure-date">
        {{ \Carbon\Carbon::parse($progress->datum_merenja)->format('d.m.Y') }}
    </h5>

    <div class="info-grid">

        <div>
            <div class="label">Težina</div>
            <div class="value">
                {{ $progress->tezina_kg ?? '-' }} kg
            </div>
        </div>

        <div>
            <div class="label">Procenat masti</div>
            <div class="value">
                {{ $progress->procenat_masti ?? '-' }} %
            </div>
        </div>

        <div>
            <div class="label">Obim struka</div>
            <div class="value">
                {{ $progress->obim_struka ?? '-' }} cm
            </div>
        </div>

        <div>
            <div class="label">Max bench</div>
            <div class="value">
                {{ $progress->max_bench_kg ?? '-' }} kg
            </div>
        </div>

    </div>

    @if($progress->napomena)
        <div class="note-box">
            <div class="note-title">Napomena</div>
            <div class="text-white">
                {{ $progress->napomena }}
            </div>
        </div>
    @endif

</div>

@empty

<div class="alert alert-info shadow-sm">
    Nema unetih merenja.
</div>

@endforelse

@endsection