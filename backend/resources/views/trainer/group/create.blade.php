@extends('trainer.layout')

@section('content')

<style>
.page-title {
    color: var(--orange);
    font-weight: 700;
    margin-bottom: 25px;
}

.form-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.4);
}

.form-label {
    color: #bbbbbb;
    font-weight: 500;
}

.form-control, .form-select {
    background-color: #2a2a33;
    border: 1px solid #333;
    color: #fff;
    border-radius: 12px;
}

.form-control:focus, .form-select:focus {
    background-color: #2a2a33;
    border-color: var(--orange);
    box-shadow: 0 0 0 0.2rem rgba(255,140,0,0.2);
    color: #fff;
}

.save-btn {
    border-radius: 12px;
    font-weight: 600;
    padding: 10px 22px;
}
</style>

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card form-card p-4">

            <h3 class="page-title">Kreiraj grupni trening</h3>

            <form method="POST" action="{{ route('trainer.group.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Naziv</label>
                    <input type="text"
                           name="naziv"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dan u nedelji</label>
                    <select name="dan_u_nedelji"
                            class="form-select"
                            required>
                        <option value="Ponedeljak">Ponedeljak</option>
                        <option value="Utorak">Utorak</option>
                        <option value="Sreda">Sreda</option>
                        <option value="Četvrtak">Četvrtak</option>
                        <option value="Petak">Petak</option>
                        <option value="Subota">Subota</option>
                        <option value="Nedelja">Nedelja</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Vreme početka</label>
                    <input type="time"
                           name="vreme_pocetka"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Trajanje (minuta)</label>
                    <input type="number"
                           name="trajanje_min"
                           class="form-control"
                           min="1"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Maksimalan broj učesnika</label>
                    <input type="number"
                           name="max_ucesnika"
                           class="form-control"
                           min="1"
                           required>
                </div>

                <button type="submit"
                        class="btn btn-warning save-btn">
                    Sačuvaj
                </button>

            </form>

        </div>

    </div>
</div>

@endsection