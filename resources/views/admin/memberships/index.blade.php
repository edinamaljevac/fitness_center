@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Članstva
</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">
        Upravljanje aktivnim i isteklim članstvima
    </p>

    <a href="{{ route('admin.memberships.create') }}"
       class="btn btn-primary ">
        + Novo članstvo
    </a>
</div>

<div class="card p-4">

    <table class="table table-dark table-hover align-middle mb-0">
        <thead>
            <tr style="color: var(--orange);">
                <th>#</th>
                <th>Član</th>
                <th>Paket</th>
                <th>Početak</th>
                <th>Kraj</th>
                <th>Preostalo treninga</th>
                <th>Status</th>
                <th class="text-end">Akcije</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($memberships as $membership)
                @php
                    $start = \Carbon\Carbon::parse($membership->datum_pocetka)->startOfDay();
                    $end = \Carbon\Carbon::parse($membership->datum_zavrsetka)->startOfDay();

                    $notStarted = $start->gt($today);
                    $expired = $end->lt($today);
                    $inRange = $start->lte($today) && $end->gte($today);
                @endphp

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td class="fw-semibold">
                        {{ $membership->member->user->name }}
                    </td>

                    <td>
                        {{ $membership->package->naziv }}
                    </td>

                    <td class="text-muted">
                        {{ $start->format('d.m.Y') }}
                    </td>

                    <td class="text-muted">
                        {{ $end->format('d.m.Y') }}
                    </td>

                    <td>
                        @if($membership->package->tip === 'T')
                            {{ $membership->preostalo_treninga }}
                        @else
                            —
                        @endif
                    </td>

                    <td>
                        @if($notStarted)
                            <span class="badge bg-info text-dark">Nije počelo</span>
                        @elseif($expired)
                            <span class="badge bg-secondary">Isteklo</span>
                        @else
                            {{-- u toku po datumima --}}
                            @if($membership->aktivno)
                                <span class="badge bg-success">Aktivno</span>
                            @else
                                <span class="badge bg-danger">Deaktivirano</span>
                            @endif
                        @endif
                    </td>

                    <td class="text-end d-flex gap-2 justify-content-end">

                        <a href="{{ route('admin.memberships.show', $membership) }}"
                           class="btn btn-sm btn-primary">
                            Detalji
                        </a>

                        {{-- Deaktivaciju dozvoli samo ako je članstvo "u toku" po datumu i aktivno --}}
                        @if ($inRange && $membership->aktivno)
                            <form method="POST"
                                  action="{{ route('admin.memberships.deactivate', $membership) }}">
                                @csrf
                                @method('PATCH')

                                <button class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Da li ste sigurni?')">
                                    Deaktiviraj
                                </button>
                            </form>
                        @endif

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Nema članstava u sistemu.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

</div>

@endsection