@extends('member.layout')

@section('content')

<h2 class="mb-4 fw-bold" style="color: var(--orange);">
    Member Dashboard
</h2>

<p class="text-muted mb-5">
    Pregled vašeg članstva, uplata i aktivnosti
</p>

<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="card p-4">
            <p class="card-title mb-2">Ukupno dolazaka</p>
            <h3 class="fw-bold" style="color: var(--orange);">
                {{ $totalVisits }}
            </h3>
            <small class="text-muted">
                Ukupan broj vaših poseta
            </small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <p class="card-title mb-2">Dolasci ovog meseca</p>
            <h3 class="fw-bold" style="color: var(--orange-soft);">
                {{ $monthlyVisits }}
            </h3>
            <small class="text-muted">
                Aktivnost u {{ now()->format('F') }}
            </small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-4">
            <p class="card-title mb-2">Ukupno minuta</p>
            <h3 class="fw-bold text-white">
                {{ $totalMinutes }}
            </h3>
            <small class="text-muted">
                Vreme provedeno u teretani
            </small>
        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-md-6">
        <div class="card p-4">
            <p class="card-title mb-2">Aktivno članstvo</p>

            @if($activeMembership)
                <h3 class="fw-bold" style="color: var(--orange);">
                    {{ $activeMembership->package->naziv }}
                </h3>

                <small class="text-muted">
                    Važi do:
                    {{ \Carbon\Carbon::parse($activeMembership->datum_zavrsetka)->format('d.m.Y') }}
                </small>

                <div class="mt-2">
                    <span class="badge bg-success">Aktivno</span>
                </div>
            @else
                <p class="text-muted">
                    Nemate aktivno članstvo.
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4">
            <p class="card-title mb-2">Status naloga</p>

            <h3 class="fw-bold">
                {{ ucfirst($member->status) }}
            </h3>

            <small class="text-muted">
                Trenutni status vašeg naloga
            </small>
        </div>
    </div>

</div>

<div class="row mt-5">
    <div class="col-12">
        <div class="card p-4">
            <h5 class="fw-bold mb-3" style="color: var(--orange);">
                Istorija uplata
            </h5>

            @if($payments->count() > 0)

                <table class="table table-dark table-hover align-middle mb-0">
                    <thead>
                        <tr style="color: var(--orange);">
                            <th>Datum</th>
                            <th>Iznos</th>
                            <th>Način plaćanja</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>
                                    {{ \Carbon\Carbon::parse($payment->datum)->format('d.m.Y') }}
                                </td>
                                <td>
                                    {{ number_format($payment->iznos, 2) }} RSD
                                </td>
                                <td>
                                    {{ ucfirst($payment->nacin_placanja) }}
                                </td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                <p class="text-muted">
                    Nemate evidentiranih uplata.
                </p>
            @endif

        </div>
    </div>
</div>

@endsection
