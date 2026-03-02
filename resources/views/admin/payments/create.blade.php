@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Nova uplata
</h2>

<div class="card p-4 col-lg-8">

    <form method="POST" action="{{ route('admin.payments.store') }}">
        @csrf

        <!-- ČLANSTVO -->
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Članstvo (član + paket)
            </label>
            <select name="membership_id"
                    class="form-select bg-dark text-white border-secondary"
                    required>
                <option value="">
                    -- Izaberite članstvo --
                </option>

                @foreach ($memberships as $membership)
                    <option value="{{ $membership->id }}">
                        {{ $membership->member->user->name }}
                        | {{ $membership->package->naziv }}
                        ({{ \Carbon\Carbon::parse($membership->datum_pocetka)->format('d.m.Y') }}
                        – {{ \Carbon\Carbon::parse($membership->datum_zavrsetka)->format('d.m.Y') }})
                    </option>
                @endforeach
            </select>

            <small class="text-muted">
                Uplata se vezuje za konkretno članstvo (član + paket + period)
            </small>
        </div>

        <!-- IZNOS -->
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Iznos (RSD)
            </label>
            <input type="number"
                   name="iznos"
                   step="0.01"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <!-- NAČIN PLAĆANJA -->
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Način plaćanja
            </label>
            <select name="nacin_placanja"
                    class="form-select bg-dark text-white border-secondary"
                    required>
                <option value="">-- Izaberite --</option>
                <option value="gotovina">Gotovina</option>
                <option value="kartica">Kartica</option>
                <option value="online">Online</option>
            </select>
        </div>

        <!-- BROJ RAČUNA -->
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Broj računa (opciono)
            </label>
            <input type="text"
                   name="broj_racuna"
                   class="form-control bg-dark text-white border-secondary">
        </div>

        <!-- NAPOMENA -->
        <div class="mb-4">
            <label class="form-label fw-semibold">
                Napomena
            </label>
            <textarea name="napomena"
                      rows="3"
                      class="form-control bg-dark text-white border-secondary"></textarea>
        </div>

        <!-- ACTIONS -->
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.payments.index') }}"
               class="btn btn-outline-light">
                ← Nazad
            </a>

            <button type="submit" class="btn btn-primary px-4">
                Sačuvaj uplatu
            </button>
        </div>

    </form>

</div>

@endsection
