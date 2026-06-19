@extends('trainer.layout')

@section('content')

<style>
.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 30px;
}

.member-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
    transition: 0.3s ease;
}

.member-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.6);
}

.member-name {
    color: #ffffff;
    font-weight: 600;
}

.member-email {
    color: #bbbbbb;
    font-size: 0.9rem;
}

.action-btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 8px 18px;
}
</style>

<h3 class="page-title">Moji članovi</h3>

@forelse($members as $member)

<div class="card member-card p-4 mb-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h5 class="member-name mb-1">
                {{ $member->ime }} {{ $member->prezime }}
            </h5>

            <div class="member-email">
                {{ $member->user->email ?? '-' }}
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap">

            <a href="{{ route('trainer.progress.create', $member) }}"
               class="btn btn-warning action-btn">
                + Dodaj merenje
            </a>

            <a href="{{ route('trainer.members.show', $member) }}"
               class="btn btn-outline-warning action-btn">
                Pogledaj napredak
            </a>

        </div>

    </div>

</div>

@empty

<div class="alert alert-info shadow-sm">
    Nemate još članova sa realizovanim treninzima.
</div>

@endforelse

@endsection