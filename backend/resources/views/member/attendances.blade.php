@extends('member.layout')

@section('content')

<h2 class="fw-bold mb-4" style="color: var(--orange);">
    Moji dolasci
</h2>

<div class="card p-4">

<table class="table table-dark table-hover align-middle">
    <thead>
        <tr style="color: var(--orange);">
            <th>Datum</th>
            <th>Ulazak</th>
            <th>Izlazak</th>
            <th>Trajanje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($attendances as $attendance)
            <tr>
                <td>{{ $attendance->datum->format('d.m.Y') }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($attendance->vreme_ulaska)->format('H:i') }}
                </td>

                <td>
                    @if($attendance->vreme_izlaska)
                        {{ \Carbon\Carbon::parse($attendance->vreme_izlaska)->format('H:i') }}
                    @else
                        -
                    @endif
                </td>

                <td>
                    @if($attendance->vreme_izlaska)

                        @php
                            $seconds = \Carbon\Carbon::parse($attendance->vreme_ulaska)
                                ->diffInSeconds($attendance->vreme_izlaska);

                            $minutes = round($seconds / 60, 2);
                        @endphp

                        {{ number_format($minutes, 2) }} min

                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>

@endsection