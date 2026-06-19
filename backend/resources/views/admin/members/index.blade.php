@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Članovi
</h2>

<div class="card p-4">

    <table class="table table-dark table-hover align-middle mb-0">
        <thead>
            <tr style="color: var(--orange);">
                <th>#</th>
                <th>Ime</th>
                <th>Email</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td class="fw-semibold">
                        {{ $member->user->name }}
                    </td>

                    <td class="text-muted">
                        {{ $member->user->email }}
                    </td>

                    <td>
                        @if ($member->status === 'aktivno')
                            <span class="badge bg-success">
                                Aktivno
                            </span>
                        @elseif ($member->status === 'pauzirano')
                            <span class="badge bg-warning text-dark">
                                Pauzirano
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                Isteklo
                            </span>
                        @endif
                    </td>

                    <td class="text-end">
                        <a href="{{ route('admin.members.show', $member) }}"
                           class="btn btn-sm btn-primary">
                            Detalji
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Nema registrovanih članova.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection
