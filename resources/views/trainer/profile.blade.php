@extends('trainer.layout')

@section('content')

<h2 class="mb-4 fw-bold" style="color: var(--orange);">
    Moj profil
</h2>

<div class="card p-4">

<form method="POST" action="{{ route('trainer.profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label class="form-label text-white">Oblast rada</label>
        <input type="text"
               name="oblast_rada"
               class="form-control"
               value="{{ old('oblast_rada', $trainer->oblast_rada) }}"
               {{ !$editMode ? 'disabled' : '' }}>
    </div>

    <div class="mb-3">
        <label class="form-label text-white">Dostupnost</label>
        <select name="dostupnost"
                class="form-select"
                {{ !$editMode ? 'disabled' : '' }}>
            <option value="1" {{ $trainer->dostupnost ? 'selected' : '' }}>
                Dostupan
            </option>
            <option value="0" {{ !$trainer->dostupnost ? 'selected' : '' }}>
                Nedostupan
            </option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label text-white">Datum zaposlenja</label>
        <input type="date"
               name="datum_zaposlenja"
               class="form-control"
               value="{{ old('datum_zaposlenja', optional($trainer->datum_zaposlenja)->format('Y-m-d')) }}"
               {{ !$editMode ? 'disabled' : '' }}>
    </div>

    <div class="mb-4">
        <label class="form-label text-white">Sertifikat</label>
        <input type="text"
               name="sertifikat"
               class="form-control"
               value="{{ old('sertifikat', $trainer->sertifikat) }}"
               {{ !$editMode ? 'disabled' : '' }}>
    </div>

    @if(!$editMode)

        <a href="{{ route('trainer.profile', ['edit' => 1]) }}"
           class="btn"
           style="background:#FF8C00; color:black; font-weight:bold;">
            Izmeni
        </a>

    @else

        <button type="submit"
                class="btn"
                style="background:#FF8C00; color:black; font-weight:bold;">
            Sačuvaj izmene
        </button>

        <a href="{{ route('trainer.profile') }}"
           class="btn btn-secondary ms-2">
            Otkaži
        </a>

    @endif

</form>

</div>

@endsection
