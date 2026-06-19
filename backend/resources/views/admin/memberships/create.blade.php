@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Kreiranje članstva
</h2>

<div class="card p-4 col-lg-8">

    <form method="POST" action="{{ route('admin.memberships.store') }}">
        @csrf

        <div class="mb-4">
            <label class="form-label fw-semibold" style="color: var(--orange);">
                Član
            </label>
            <select name="member_id"
                    class="form-select bg-dark text-white border-secondary"
                    required>
                <option value="">-- Izaberite člana --</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}">
                        {{ $member->user->name }} ({{ $member->user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold" style="color: var(--orange);">
                Paket
            </label>
            <select name="package_id"
                    class="form-select bg-dark text-white border-secondary"
                    required>
                <option value="">-- Izaberite paket --</option>
                @foreach ($packages as $package)
                    <option value="{{ $package->id }}">
                        {{ $package->naziv }} – {{ $package->trajanje_dana }} dana
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold" style="color: var(--orange);">
                Datum početka
            </label>
            <input type="date"
                   name="datum_pocetka"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.memberships.index') }}"
               class="btn btn-outline-light">
                ← Nazad
            </a>

            <button type="submit" class="btn btn-primary px-4">
                Sačuvaj članstvo
            </button>
        </div>

    </form>

</div>

@endsection
