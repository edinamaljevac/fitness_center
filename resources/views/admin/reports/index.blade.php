@extends('admin.layout')

@section('content')

<style>
.section-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 25px;
}

.stat-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 18px;
    padding: 25px;
    text-align: center;
    transition: 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.6);
}

.stat-label {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #8c8c98;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 700;
}

.stat-green { color: #00ff95; }
.stat-yellow { color: #ffc107; }
.stat-blue { color: #4da3ff; }

.list-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border-radius: 18px;
    padding: 25px;
    border: 1px solid rgba(255,255,255,0.05);
}

.list-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-card li {
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.list-card li:last-child {
    border-bottom: none;
}
</style>

<h2 class="section-title">
    Izveštaji i statistika
</h2>

{{-- ================= PRIHOD ================= --}}
<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Ukupan prihod</div>
            <div class="stat-value stat-green">
                {{ number_format($totalRevenue, 2) }} RSD
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Prihod ovog meseca</div>
            <div class="stat-value stat-yellow">
                {{ number_format($monthlyRevenue, 2) }} RSD
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Aktivni članovi</div>
            <div class="stat-value stat-blue">
                {{ $activeMembers }}
            </div>
        </div>
    </div>

</div>

{{-- ================= DOLASCI ================= --}}
<h4 class="section-title">Statistika dolazaka</h4>

<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Ukupni dolasci</div>
            <div class="stat-value stat-blue">
                {{ $totalAttendances }}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Dolasci ovog meseca</div>
            <div class="stat-value stat-yellow">
                {{ $monthlyAttendances }}
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Prosek po članu</div>
            <div class="stat-value stat-green">
                {{ number_format($avgAttendancesPerMember, 2) }}
            </div>
        </div>
    </div>

</div>

{{-- ================= NOVI ČLANOVI ================= --}}
<h4 class="section-title">
    Novi članovi po mesecima ({{ now()->year }})
</h4>

<div class="list-card mb-5">

    @if($membersPerMonth->isEmpty())
        <p class="text-muted mb-0">Nema podataka za ovu godinu.</p>
    @else
        <ul>
            @foreach($membersPerMonth as $month => $total)
                <li>
                    Mesec {{ $month }}
                    <span class="float-end fw-bold">
                        {{ $total }} članova
                    </span>
                </li>
            @endforeach
        </ul>
    @endif

</div>

{{-- ================= RAD TRENERA ================= --}}
<h4 class="section-title">Rad trenera</h4>

<div class="list-card">

    @if($trainersStats->isEmpty())
        <p class="text-muted mb-0">Nema podataka o trenerima.</p>
    @else
        <ul>
            @foreach($trainersStats as $trainer)
                <li>
                    <strong>{{ $trainer->user->name ?? 'Trener' }}</strong>
                    <span class="float-end">
                        {{ $trainer->trainings_count }} treninga |
                        Ocena:
                        {{ $trainer->avg_rating ? number_format($trainer->avg_rating, 2) : 'Nema ocena' }}
                    </span>
                </li>
            @endforeach
        </ul>
    @endif

</div>

@endsection