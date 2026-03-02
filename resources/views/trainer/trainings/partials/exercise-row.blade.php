@php
    $iVal = $i;
@endphp

<div class="border border-secondary rounded-3 p-3" style="background-color: var(--mid-gray);" data-row>
    <div class="d-flex justify-content-between align-items-center mb-2">
        <strong style="color: var(--light-gray);">Vežba</strong>
        <button type="button" class="btn btn-sm btn-outline-danger" data-remove {{ $locked ? 'disabled' : '' }}>
            Ukloni
        </button>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">Izaberi vežbu *</label>
            <select class="form-select bg-dark text-white border-secondary"
                    data-name="items[__INDEX__][exercise_id]"
                    name="items[{{ $iVal }}][exercise_id]"
                    {{ $locked ? 'disabled' : '' }}
                    required>
                <option value="">-- izaberi --</option>
                @foreach($exercises as $ex)
                    <option value="{{ $ex->id }}"
                        @if($row && (int)$row['exercise_id'] === (int)$ex->id) selected @endif>
                        {{ $ex->naziv }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">Redosled</label>
            <input type="number" min="1" class="form-control bg-dark text-white border-secondary"
                   data-name="items[__INDEX__][redosled]"
                   name="items[{{ $iVal }}][redosled]"
                   value="{{ $row['redosled'] ?? '' }}"
                   {{ $locked ? 'disabled' : '' }}>
        </div>

        <div class="col-md-2">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">Serije</label>
            <input type="number" min="1" class="form-control bg-dark text-white border-secondary"
                   data-name="items[__INDEX__][broj_serija]"
                   name="items[{{ $iVal }}][broj_serija]"
                   value="{{ $row['broj_serija'] ?? '' }}"
                   {{ $locked ? 'disabled' : '' }}>
        </div>

        <div class="col-md-2">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">Ponavljanja</label>
            <input type="number" min="1" class="form-control bg-dark text-white border-secondary"
                   data-name="items[__INDEX__][broj_ponavljanja]"
                   name="items[{{ $iVal }}][broj_ponavljanja]"
                   value="{{ $row['broj_ponavljanja'] ?? '' }}"
                   {{ $locked ? 'disabled' : '' }}>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">Težina (kg)</label>
            <input type="number" step="0.5" min="0" class="form-control bg-dark text-white border-secondary"
                   data-name="items[__INDEX__][tezina_kg]"
                   name="items[{{ $iVal }}][tezina_kg]"
                   value="{{ $row['tezina_kg'] ?? '' }}"
                   {{ $locked ? 'disabled' : '' }}>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">Odmor (sec)</label>
            <input type="number" min="0" class="form-control bg-dark text-white border-secondary"
                   data-name="items[__INDEX__][odmor_sec]"
                   name="items[{{ $iVal }}][odmor_sec]"
                   value="{{ $row['odmor_sec'] ?? '' }}"
                   {{ $locked ? 'disabled' : '' }}>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-semibold mb-1" style="color: var(--light-gray);">Napomena</label>
            <input type="text" class="form-control bg-dark text-white border-secondary"
                   data-name="items[__INDEX__][napomena]"
                   name="items[{{ $iVal }}][napomena]"
                   value="{{ $row['napomena'] ?? '' }}"
                   {{ $locked ? 'disabled' : '' }}>
        </div>
    </div>
</div>