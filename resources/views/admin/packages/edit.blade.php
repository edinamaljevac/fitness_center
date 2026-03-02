@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Izmena paketa
</h2>

<div class="card p-4 col-lg-8">

    <form method="POST"
          action="{{ route('admin.packages.update', $package) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="form-label fw-semibold">Naziv paketa</label>
            <input type="text"
                   name="naziv"
                   value="{{ old('naziv', $package->naziv) }}"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Opis paketa</label>
            <textarea name="opis"
                      rows="3"
                      class="form-control bg-dark text-white border-secondary">{{ old('opis', $package->opis) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Cena (RSD)</label>
            <input type="number"
                   name="cena"
                   step="0.01"
                   value="{{ old('cena', $package->cena) }}"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Trajanje (u danima)</label>
            <input type="number"
                   name="trajanje_dana"
                   value="{{ old('trajanje_dana', $package->trajanje_dana) }}"
                   class="form-control bg-dark text-white border-secondary"
                   required>
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Tip paketa</label>
            <select name="tip"
                    class="form-select bg-dark text-white border-secondary"
                    required>
                <option value="M" {{ old('tip', $package->tip) === 'M' ? 'selected' : '' }}>Mesečni</option>
                <option value="G" {{ old('tip', $package->tip) === 'G' ? 'selected' : '' }}>Godišnji</option>
                <option value="D" {{ old('tip', $package->tip) === 'D' ? 'selected' : '' }}>Dnevni</option>
                <option value="T" {{ old('tip', $package->tip) === 'T' ? 'selected' : '' }}>Sa trenerom</option>
            </select>
        </div>

        <div class="mb-4" id="brojTreningaWrapper">
            <label class="form-label fw-semibold">Broj personalnih treninga</label>
            <input type="number"
                   name="broj_treninga"
                   min="1"
                   value="{{ old('broj_treninga', $package->broj_treninga) }}"
                   class="form-control bg-dark text-white border-secondary">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.packages.index') }}"
               class="btn btn-outline-light">
                ← Nazad
            </a>

            <button type="submit" class="btn btn-primary px-4">
                Sačuvaj izmene
            </button>
        </div>

    </form>

</div>

<script>
    const tipSelect = document.querySelector('select[name="tip"]');
    const brojWrapper = document.getElementById('brojTreningaWrapper');

    function toggleBrojTreninga() {
        if (tipSelect.value === 'T') {
            brojWrapper.style.display = 'block';
        } else {
            brojWrapper.style.display = 'none';
        }
    }

    toggleBrojTreninga();
    tipSelect.addEventListener('change', toggleBrojTreninga);
</script>

@endsection
