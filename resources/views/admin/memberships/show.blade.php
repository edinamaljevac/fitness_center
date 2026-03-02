@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Detalji članstva
</h2>

<div class="row g-4">

    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h5 class="mb-3" style="color: var(--orange);">
                Osnovne informacije
            </h5>

            <p>
                <strong>Član:</strong><br>
                {{ $membership->member->user->name }}<br>
                <span class="text-muted">
                    {{ $membership->member->user->email }}
                </span>
            </p>

            <p>
                <strong>Paket:</strong><br>
                {{ $membership->package->naziv }}
            </p>

            @if($membership->package->tip === 'T')
                <p>
                    <strong>Preostalo personalnih treninga:</strong><br>
                    {{ $membership->preostalo_treninga }}
                </p>
            @endif

            <p>
                <strong>Status:</strong><br>
                @if ($membership->aktivno)
                    <span class="badge bg-success">
                        Aktivno
                    </span>
                @else
                    <span class="badge bg-secondary">
                        Neaktivno
                    </span>
                @endif
            </p>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h5 class="mb-3" style="color: var(--orange);">
                Trajanje članstva
            </h5>

            <p>
                <strong>Datum početka:</strong><br>
                {{ \Carbon\Carbon::parse($membership->datum_pocetka)->format('d.m.Y') }}
            </p>

            <p>
                <strong>Datum završetka:</strong><br>
                {{ \Carbon\Carbon::parse($membership->datum_zavrsetka)->format('d.m.Y') }}
            </p>

            <p>
                <strong>Kreirano:</strong><br>
                {{ $membership->created_at->format('d.m.Y H:i') }}
            </p>
        </div>
    </div>

</div>

<div class="card p-4 mt-4">
    <div class="d-flex justify-content-between align-items-center">

        <a href="{{ route('admin.memberships.index') }}"
           class="btn btn-outline-light">
            ← Nazad na listu
        </a>

        @if ($membership->aktivno)
            <form method="POST"
                  action="{{ route('admin.memberships.deactivate', $membership) }}">
                @csrf
                @method('PATCH')

                <button class="btn btn-outline-danger"
                        onclick="return confirm('Da li ste sigurni da želite da deaktivirate članstvo?')">
                    Deaktiviraj članstvo
                </button>
            </form>
        @endif

    </div>
</div>

@endsection
