@extends('admin.layout')

@section('content')
<h2 class="fw-bold mb-4" style="color: var(--orange);">Nova vežba</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card p-4" style="background-color: var(--dark-gray); border-radius: 15px;">
    <form method="POST" action="{{ route('admin.exercises.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">
                Naziv *
            </label>
            <input type="text"
                   name="naziv"
                   value="{{ old('naziv') }}"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">
                Kategorija
            </label>
            <input type="text"
                   name="kategorija"
                   value="{{ old('kategorija') }}"
                   class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">
                Mišićna grupa
            </label>
            <input type="text"
                   name="misicna_grupa"
                   value="{{ old('misicna_grupa') }}"
                   class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">
                Oprema
            </label>
            <input type="text"
                   name="oprema"
                   value="{{ old('oprema') }}"
                   class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">
                Opis
            </label>
            <textarea name="opis"
                      rows="4"
                      class="form-control bg-dark text-white border-secondary">{{ old('opis') }}</textarea>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button class="btn btn-warning px-4">Sačuvaj</button>
            <a href="{{ route('admin.exercises.index') }}" class="btn btn-outline-light px-4">
                Nazad
            </a>
        </div>
    </form>
</div>
@endsection