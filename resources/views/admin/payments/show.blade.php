@extends('admin.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Detalji uplate
</h2>

<a href="{{ route('admin.payments.index') }}"
   class="btn btn-outline-light mb-4">
    Nazad na uplate
</a>

<div class="card p-4">

    <div class="row mb-3">
        <div class="col-md-6">
            <p class="card-title mb-1">Član</p>
            <h5 class="fw-bold">
                {{ $payment->membership->member->user->name }}
            </h5>
        </div>

        <div class="col-md-6">
            <p class="card-title mb-1">Paket</p>
            <h5 class="fw-bold">
                {{ $payment->membership->package->naziv }}
            </h5>
        </div>
    </div>

    <hr style="border-color: #2A2A33;">

    <div class="row mb-3">
        <div class="col-md-4">
            <p class="card-title mb-1">Iznos</p>
            <h4 style="color: var(--orange-soft);">
                {{ number_format($payment->iznos, 2) }} RSD
            </h4>
        </div>

        <div class="col-md-4">
            <p class="card-title mb-1">Datum uplate</p>
            <h5>
                {{ \Carbon\Carbon::parse($payment->datum)->format('d.m.Y') }}
            </h5>
        </div>

        <div class="col-md-4">
            <p class="card-title mb-1">Status</p>
            <span class="badge bg-success fs-6">
                {{ ucfirst($payment->status) }}
            </span>
        </div>
    </div>

    <hr style="border-color: #2A2A33;">

    <div class="row">
        <div class="col-md-6">
            <p class="card-title mb-1">Kreirano</p>
            <p class="text-muted">
                {{ $payment->created_at->format('d.m.Y H:i') }}
            </p>
        </div>

        <div class="col-md-6">
            <p class="card-title mb-1">Poslednja izmena</p>
            <p class="text-muted">
                {{ $payment->updated_at->format('d.m.Y H:i') }}
            </p>
        </div>
    </div>

</div>

@endsection
