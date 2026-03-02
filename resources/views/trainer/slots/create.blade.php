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

.form-control {
    background-color: #2a2a33;
    border: 1px solid #333;
    color: #fff;
    border-radius: 12px;
}

.form-control:focus {
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

.back-btn {
    border-radius: 12px;
}
</style>

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card form-card p-4">

            <h3 class="page-title">Kreiraj personalni termin</h3>

            @if(session('success'))
                <div class="alert alert-success shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger shadow-sm">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('trainer.slots.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Datum</label>
                    <input type="date"
                           name="datum"
                           class="form-control"
                           value="{{ old('datum') }}"
                           min="{{ date('Y-m-d') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Vreme početka</label>
                    <input type="time"
                           name="vreme_pocetka"
                           class="form-control"
                           value="{{ old('vreme_pocetka') }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Trajanje (minuta)</label>
                    <input type="number"
                           name="trajanje_min"
                           class="form-control"
                           min="1"
                           value="{{ old('trajanje_min') }}"
                           required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('trainer.slots.index') }}"
                       class="btn btn-secondary back-btn">
                        Nazad
                    </a>

                    <button type="submit"
                            class="btn btn-warning save-btn">
                        Sačuvaj termin
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection