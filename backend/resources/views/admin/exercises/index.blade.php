@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold" style="color: var(--orange);">Vežbe</h2>

    <a href="{{ route('admin.exercises.create') }}" class="btn btn-warning">
        + Nova vežba
    </a>
</div>



<div class="card p-3 mb-4">
    <form method="GET" action="{{ route('admin.exercises.index') }}" class="row g-2">
        <div class="col-md-3">
            <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Pretraga po nazivu...">
        </div>
        <div class="col-md-3">
            <input type="text" name="kategorija" value="{{ request('kategorija') }}" class="form-control" placeholder="Kategorija">
        </div>
        <div class="col-md-3">
            <input type="text" name="misicna_grupa" value="{{ request('misicna_grupa') }}" class="form-control" placeholder="Mišićna grupa">
        </div>
        <div class="col-md-3">
            <input type="text" name="oprema" value="{{ request('oprema') }}" class="form-control" placeholder="Oprema">
        </div>

        <div class="col-12 d-flex gap-2 mt-2">
            <button class="btn btn-outline-light" type="submit">Filtriraj</button>
            <a href="{{ route('admin.exercises.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Kategorija</th>
                    <th>Mišićna grupa</th>
                    <th>Oprema</th>
                    <th class="text-end">Akcije</th>
                </tr>
            </thead>
            <tbody>
                @forelse($exercises as $ex)
                    <tr>
                        <td class="fw-semibold">{{ $ex->naziv }}</td>
                        <td>{{ $ex->kategorija ?? '-' }}</td>
                        <td>{{ $ex->misicna_grupa ?? '-' }}</td>
                        <td>{{ $ex->oprema ?? '-' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.exercises.edit', $ex) }}" class="btn btn-sm btn-outline-warning">
                                Izmeni
                            </a>

                            <form action="{{ route('admin.exercises.destroy', $ex) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Da li ste sigurni da želite da obrišete vežbu?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Obriši</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            Nema vežbi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $exercises->links() }}
    </div>
</div>
@endsection