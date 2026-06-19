@extends('trainer.layout')

@section('content')
<h2 class="fw-bold mb-4" style="color: var(--orange);">Moji treninzi</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card p-3" style="background-color: var(--dark-gray); border-radius: 15px;">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Vreme</th>
                    <th>Član</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($trainings as $t)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($t->datum)->format('d.m.Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->vreme_pocetka)->format('H:i') }}</td>
                        <td>{{ $t->member?->user?->name ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('trainer.trainings.edit', $t) }}" class="btn btn-sm btn-outline-warning">
                                Unesi vežbe
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Nema treninga.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection