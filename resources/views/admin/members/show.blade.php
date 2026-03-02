@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Detalji člana
</h2>

<div class="row g-4">

    <!-- OSNOVNI PODACI -->
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h5 class="mb-3" style="color: var(--orange);">
                Osnovni podaci
            </h5>

            <p>
                <strong>Ime:</strong><br>
                {{ $member->user->name }}
            </p>

            <p>
                <strong>Email:</strong><br>
                {{ $member->user->email }}
            </p>

            <p>
                <strong>Status člana:</strong><br>
                @if ($member->status === 'aktivno')
                    <span class="badge bg-success">Aktivno</span>
                @elseif ($member->status === 'pauzirano')
                    <span class="badge bg-warning text-dark">Pauzirano</span>
                @else
                    <span class="badge bg-secondary">Isteklo</span>
                @endif
            </p>
        </div>
    </div>

    <!-- PROMENA STATUSA -->
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h5 class="mb-3" style="color: var(--orange);">
                Promena statusa člana
            </h5>

            <form method="POST"
                  action="{{ route('admin.members.updateStatus', $member) }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Status
                    </label>
                    <select name="status"
                            class="form-select bg-dark text-white border-secondary"
                            required>
                        <option value="aktivno" {{ $member->status === 'aktivno' ? 'selected' : '' }}>
                            Aktivno
                        </option>
                        <option value="pauzirano" {{ $member->status === 'pauzirano' ? 'selected' : '' }}>
                            Pauzirano
                        </option>
                        <option value="isteklo" {{ $member->status === 'isteklo' ? 'selected' : '' }}>
                            Isteklo
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Sačuvaj status
                </button>
            </form>
        </div>
    </div>

</div>

<!-- ČLANSTVA -->
<div class="card p-4 mt-4">
    <h5 class="mb-3" style="color: var(--orange);">
        Članstva
    </h5>

    @if ($member->memberships->count() === 0)
        <p class="text-muted">
            Član nema evidentiranih članstava.
        </p>
    @else
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr style="color: var(--orange);">
                    <th>Paket</th>
                    <th>Početak</th>
                    <th>Kraj</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($member->memberships as $membership)
                    <tr>
                        <td>{{ $membership->package->naziv }}</td>

                        <td class="text-muted">
                            {{ \Carbon\Carbon::parse($membership->datum_pocetka)->format('d.m.Y') }}
                        </td>

                        <td class="text-muted">
                            {{ \Carbon\Carbon::parse($membership->datum_zavrsetka)->format('d.m.Y') }}
                        </td>

                        <td>
                            @if ($membership->aktivno)
                                <span class="badge bg-success">Aktivno</span>
                            @else
                                <span class="badge bg-secondary">Neaktivno</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<div class="card p-4 mt-4">
    <h5 class="mb-3" style="color: var(--orange);">
        Evidencija dolaska
    </h5>

    @if(!$todayAttendance)
    <form method="POST" action="{{ route('admin.attendances.checkIn', $member) }}">
        @csrf
        <button class="btn btn-primary">Evidentiraj dolazak (Check-in)</button>
    </form>
@else
    <form method="POST" action="{{ route('admin.attendances.checkOut', $todayAttendance) }}">
        @csrf
        @method('PATCH')
        <button class="btn btn-outline-danger">Evidentiraj izlazak (Check-out)</button>
    </form>
@endif

</div>


<div class="mt-4">
    <a href="{{ route('admin.members.index') }}"
       class="btn btn-outline-light">
        ← Nazad na listu članova
    </a>
</div>

@endsection
