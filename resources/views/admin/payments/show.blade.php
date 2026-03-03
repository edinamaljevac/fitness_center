@extends('admin.layout')

@section('content')

<style>
.details-card {
    background: linear-gradient(145deg, #1C1C22, #23232b);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.5);
}

.section-title {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #8c8c98;
    margin-bottom: 6px;
}

.value-main {
    font-size: 1.4rem;
    font-weight: 600;
    color: #ffffff;
}

.value-accent {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--orange);
}

.meta-text {
    font-size: 0.95rem;
    color: #bcbcc7;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.status-success {
    background: linear-gradient(135deg, #1f3d2b, #164d33);
    color: #00ff95;
}
</style>

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Detalji uplate
</h2>

<a href="{{ route('admin.payments.index') }}"
   class="btn btn-outline-light mb-4 px-4 py-2 rounded-3">
    ← Nazad na uplate
</a>

<div class="details-card p-5">

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="section-title">Član</div>
            <div class="value-main">
                {{ $payment->membership->member->user->name }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="section-title">Paket</div>
            <div class="value-main">
                {{ $payment->membership->package->naziv }}
            </div>
        </div>
    </div>

    <hr style="border-color: #2A2A33; margin: 30px 0;">

    <div class="row mb-4 align-items-center">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="section-title">Iznos</div>
            <div class="value-accent">
                {{ number_format($payment->iznos, 2) }} RSD
            </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
            <div class="section-title">Datum uplate</div>
            <div class="value-main">
                {{ \Carbon\Carbon::parse($payment->datum)->format('d.m.Y') }}
            </div>
        </div>

        <div class="col-md-4">
            <div class="section-title">Status</div>
            <span class="status-badge status-success">
                {{ ucfirst($payment->status) }}
            </span>
        </div>
    </div>

    <hr style="border-color: #2A2A33; margin: 30px 0;">

    <div class="row">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="section-title">Kreirano</div>
            <div class="meta-text">
                {{ $payment->created_at->format('d.m.Y H:i') }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="section-title">Poslednja izmena</div>
            <div class="meta-text">
                {{ $payment->updated_at->format('d.m.Y H:i') }}
            </div>
        </div>
    </div>

</div>

@endsection