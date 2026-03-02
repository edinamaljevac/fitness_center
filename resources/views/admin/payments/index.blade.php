@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Uplate
</h2>

<div class="d-flex justify-content-between align-items-center mb-3">
    <p class="text-muted mb-0">
        Evidencija svih uplata članova
    </p>

    <a href="{{ route('admin.payments.create') }}"
       class="btn btn-primary">
        + Nova uplata
    </a>
</div>

<div class="card p-4">

    <table class="table table-dark table-hover align-middle mb-0">
        <thead>
            <tr style="color: var(--orange);">
                <th>#</th>
                <th>Član</th>
                <th>Paket</th>
                <th>Iznos (RSD)</th>
                <th>Datum</th>
                <th>Status</th>
                <th class="text-end">Akcije</th>
            </tr>
        </thead>
        <tbody>

            @forelse ($payments as $payment)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td class="fw-semibold">
                        {{ $payment->membership->member->user->name }}
                    </td>

                    <td>
                        {{ $payment->membership->package->naziv }}
                    </td>

                    <td>
                        {{ number_format($payment->iznos, 2) }}
                    </td>

                    <td class="text-muted">
                        {{ \Carbon\Carbon::parse($payment->datum)->format('d.m.Y') }}
                    </td>

                    <td>
                        <span class="badge bg-success">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </td>

                    <td class="text-end">
                        <a href="{{ route('admin.payments.show', $payment) }}"
                           class="btn btn-sm btn-outline-light">
                            Detalji
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        Nema evidentiranih uplata.
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>

</div>

@endsection
