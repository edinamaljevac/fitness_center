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
    padding: 10px 14px;
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
    padding: 12px 24px;
}
</style>

<h3 class="page-title">
    Novo merenje za 
    <span class="text-white">
        {{ $member->user->name }}
    </span>
</h3>

<form method="POST" action="{{ route('trainer.progress.store', $member) }}">
@csrf

<div class="card form-card p-4 mb-4">

    <!-- DATUM -->
    <div class="mb-4">
        <label class="form-label">Datum merenja</label>
        <input type="date"
               name="datum_merenja"
               class="form-control"
               required>
    </div>

    <!-- PRVI RED -->
    <div class="row">

        <div class="col-md-4 mb-4">
            <label class="form-label">Težina (kg)</label>
            <input type="number"
                   step="0.1"
                   name="tezina_kg"
                   class="form-control">
        </div>

        <div class="col-md-4 mb-4">
            <label class="form-label">% masti</label>
            <input type="number"
                   step="0.1"
                   name="procenat_masti"
                   class="form-control">
        </div>

        <div class="col-md-4 mb-4">
            <label class="form-label">Obim struka (cm)</label>
            <input type="number"
                   step="0.1"
                   name="obim_struka"
                   class="form-control">
        </div>

    </div>

    <!-- DRUGI RED -->
    <div class="row">

        <div class="col-md-6 mb-4">
            <label class="form-label">Max bench (kg)</label>
            <input type="number"
                   step="0.1"
                   name="max_bench_kg"
                   class="form-control">
        </div>

        <div class="col-md-6 mb-4">
            <label class="form-label">Max čučanj (kg)</label>
            <input type="number"
                   step="0.1"
                   name="max_cucanj_kg"
                   class="form-control">
        </div>

    </div>

    <div class="mb-4">
        <label class="form-label">Napomena</label>
        <textarea name="napomena"
                  rows="4"
                  class="form-control"></textarea>
    </div>

    <button class="btn btn-warning save-btn">
        Sačuvaj merenje
    </button>

</div>

</form>

@endsection