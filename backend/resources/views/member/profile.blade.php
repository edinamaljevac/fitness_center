@extends('member.layout')

@section('content')

<h2 class="mb-4 fw-bold" style="color: var(--orange);">
    Moj profil
</h2>


<div class="card p-4">

    <form method="POST" action="{{ route('member.profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label class="form-label text-white">Datum rođenja</label>
            <input type="date"
                   name="datum_rodjenja"
                   class="form-control"
                   value="{{ old('datum_rodjenja', $member->datum_rodjenja) }}"
                   {{ !$editMode ? 'disabled' : '' }}>
        </div>

        <div class="mb-3">
            <label class="form-label text-white">Adresa</label>
            <input type="text"
                   name="adresa"
                   class="form-control"
                   value="{{ old('adresa', $member->adresa) }}"
                   {{ !$editMode ? 'disabled' : '' }}>
        </div>

        <div class="mb-4">
            <label class="form-label text-white">Visina (cm)</label>
            <input type="number"
                   name="visina_cm"
                   class="form-control"
                   value="{{ old('visina_cm', $member->visina_cm) }}"
                   {{ !$editMode ? 'disabled' : '' }}>
        </div>

        @if(!$editMode)

            <a href="{{ route('member.profile', ['edit' => 1]) }}"
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

            <a href="{{ route('member.profile') }}"
               class="btn btn-secondary ms-2">
                Otkaži
            </a>

        @endif

    </form>

</div>

@endsection
