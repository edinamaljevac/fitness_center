@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Paketi
</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">
        Upravljanje fitnes paketima
    </p>

    <a href="{{ route('admin.packages.create') }}"
       class="btn btn-primary">
        + Novi paket
    </a>
</div>

<div class="card p-4">

    <table class="table table-dark table-hover align-middle mb-0">
        <thead>
            <tr style="color: var(--orange);">
                <th>#</th>
                <th>Naziv</th>
                <th>Cena (RSD)</th>
                <th>Trajanje</th>
                <th>Broj treninga</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @forelse ($packages as $package)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td class="fw-semibold">
                        {{ $package->naziv }}
                    </td>

                    <td>
                        {{ number_format($package->cena, 2) }}
                    </td>

                    <td class="text-muted">
                        {{ $package->trajanje_dana }} dana
                    </td>

                    <td>
                        @if($package->tip === 'T')
                            {{ $package->broj_treninga }}
                        @else
                            —
                        @endif
                    </td>

                    <td>
                        @if ($package->aktivan)
                            <span class="badge bg-success">
                                Aktivan
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                Neaktivan
                            </span>
                        @endif
                    </td>

                    <td class="text-end d-flex gap-2 justify-content-end">

                        <a href="{{ route('admin.packages.edit', $package) }}"
                           class="btn btn-sm btn-outline-light">
                            Izmeni
                        </a>

                        <form method="POST"
                              action="{{ route('admin.packages.toggle', $package) }}">
                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    class="btn btn-sm btn-outline-warning">
                                Promeni status
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Nema paketa u sistemu.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

</div>

@endsection
