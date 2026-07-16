@extends('layouts.app')

@section('content')

@include('layouts.navbar')
@php

$gdpWinner = ($gdpA && $gdpB)
    ? ($gdpA['value'] > $gdpB['value'] ? 'A' : 'B')
    : null;

$inflationWinner = ($inflationA && $inflationB)
    ? ($inflationA['value'] < $inflationB['value'] ? 'A' : 'B')
    : null;

$riskWinner = ($riskA < $riskB)
    ? 'A'
    : 'B';

@endphp

<div class="container-fluid">

<div class="card shadow-sm border-0 mb-4">

<div class="card-header"
style="background:#F6F0EA;">

<h4 class="fw-bold mb-0"
style="color:#6F4E37;">
🌍 Country Comparison
</h4>

</div>

<div class="card-body">

<form method="GET">

<div class="row">

<div class="col-md-5">

<label class="fw-bold mb-2">

Country A

</label>

<select
name="countryA"
class="form-select">

@foreach($countries as $country)

<option
value="{{ $country->name }}"
{{ $countryA==$country->name?'selected':'' }}>

{{ $country->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-2 d-flex align-items-end justify-content-center">

<h2 style="color:#6F4E37;font-weight:700;">
    VS
</h2>

</div>

<div class="col-md-5">

<label class="fw-bold mb-2">

Country B

</label>

<select
name="countryB"
class="form-select">

@foreach($countries as $country)

<option
value="{{ $country->name }}"
{{ $countryB==$country->name?'selected':'' }}>

{{ $country->name }}

</option>

@endforeach

</select>

</div>

</div>

<div class="mt-4">

<button
class="btn"
style="background:#6F4E37;color:white;border:none;">

Compare

</button>

</div>

</form>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="card shadow-sm">

<div class="card-header d-flex justify-content-between align-items-center">

    <b style="color:#6F4E37;">
        {{ $countryA }}
    </b>

    <form action="{{ route('watchlist.store') }}" method="POST" class="mb-0">

        @csrf

        <input
            type="hidden"
            name="country"
            value="{{ $countryA }}">

        <button
            type="submit"
            class="btn btn-sm"
            style="background:#8B5E3C;color:white;">

            👁 Watch

        </button>

    </form>

</div>

<div class="card-body">

<table class="table">

<tr>

<th>Capital</th>

<td>{{ $dataA->capital }}</td>

</tr>

<tr>

<th>Region</th>

<td>{{ $dataA->region }}</td>

</tr>

<tr>

<th>Currency</th>

<td>{{ $dataA->currency_name }}</td>

</tr>

<tr>

<th>Currency Code</th>

<td>{{ $dataA->currency_code }}</td>

</tr>

<tr>
    <th>GDP</th>
    <td>
        @if($gdpWinner=='A')
            <span class="fw-bold text-success">
                🏆 {{ '$'.number_format($gdpA['value']/1000000000000,2).' T' }}
            </span>
        @else
            {{ $gdpA ? '$'.number_format($gdpA['value']/1000000000000,2).' T' : '-' }}
        @endif
    </td>
</tr>

<tr>
    <th>Inflation</th>
    <td>
        @if($inflationWinner=='A')
            <span class="fw-bold text-success">
                🏆 {{ number_format($inflationA['value'],2) }} %
            </span>
        @else
            {{ $inflationA ? number_format($inflationA['value'],2).' %' : '-' }}
        @endif
    </td>
</tr>

<tr>
    <th>Weather</th>
    <td>
        {{ $weatherTextA }}
        ({{ $weatherA['current']['temperature_2m'] ?? '-' }} °C)
    </td>
</tr>

<tr>
    <th>Risk Score</th>
    <td>

        @if($riskWinner=='A')

            @if($riskA<40)
                <span class="badge bg-success">🏆 Low</span>
            @elseif($riskA<70)
                <span class="badge bg-warning text-dark">🏆 Medium</span>
            @else
                <span class="badge bg-danger">🏆 High</span>
            @endif

        @else

            @if($riskA<40)
                <span class="badge bg-success">Low</span>
            @elseif($riskA<70)
                <span class="badge bg-warning text-dark">Medium</span>
            @else
                <span class="badge bg-danger">High</span>
            @endif

        @endif

    </td>
</tr>

</table>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card shadow-sm">

<div class="card-header d-flex justify-content-between align-items-center">

    <b style="color:#6F4E37;">
        {{ $countryB }}
    </b>

    <form action="{{ route('watchlist.store') }}" method="POST" class="mb-0">

        @csrf

        <input
            type="hidden"
            name="country"
            value="{{ $countryB }}">

        <button
            type="submit"
            class="btn btn-sm"
            style="background:#8B5E3C;color:white;">

            👁 Watch

        </button>

    </form>

</div>

<div class="card-body">

<table class="table">

<tr>
    <th>Capital</th>
    <td>{{ $dataB->capital }}</td>
</tr>

<tr>
    <th>Region</th>
    <td>{{ $dataB->region }}</td>
</tr>

<tr>
    <th>Currency</th>
    <td>{{ $dataB->currency_name }}</td>
</tr>

<tr>
    <th>Currency Code</th>
    <td>{{ $dataB->currency_code }}</td>
</tr>

<tr>
    <th>GDP</th>
    <td>

        @if($gdpWinner=='B')
            <span class="fw-bold text-success">
                🏆 {{ '$'.number_format($gdpB['value']/1000000000000,2).' T' }}
            </span>
        @else
            {{ $gdpB ? '$'.number_format($gdpB['value']/1000000000000,2).' T' : '-' }}
        @endif

    </td>
</tr>

<tr>
    <th>Inflation</th>
    <td>

        @if($inflationWinner=='B')
            <span class="fw-bold text-success">
                🏆 {{ number_format($inflationB['value'],2) }} %
            </span>
        @else
            {{ $inflationB ? number_format($inflationB['value'],2).' %' : '-' }}
        @endif

    </td>
</tr>

<tr>
    <th>Weather</th>
    <td>
        {{ $weatherTextB }}
        ({{ $weatherB['current']['temperature_2m'] ?? '-' }} °C)
    </td>
</tr>

<tr>
    <th>Risk Score</th>
    <td>

        @if($riskWinner=='B')

            @if($riskB<40)
                <span class="badge bg-success">🏆 Low</span>
            @elseif($riskB<70)
                <span class="badge bg-warning text-dark">🏆 Medium</span>
            @else
                <span class="badge bg-danger">🏆 High</span>
            @endif

        @else

            @if($riskB<40)
                <span class="badge bg-success">Low</span>
            @elseif($riskB<70)
                <span class="badge bg-warning text-dark">Medium</span>
            @else
                <span class="badge bg-danger">High</span>
            @endif

        @endif

    </td>
</tr>

</table>

</div>

</div>

</div>

</div>

<div class="card shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">
            📊 Comparison Summary
        </h5>

    </div>

    <div class="card-body">

        <ul class="mb-0">

            <li>
                <strong>🏆 GDP :</strong>
                {{ $gdpWinner=='A' ? $countryA : $countryB }}
                has a stronger economy.
            </li>

            <li>
                <strong>📈 Inflation :</strong>
                {{ $inflationWinner=='A' ? $countryA : $countryB }}
                has lower inflation.
            </li>

            <li>
                <strong>⚠️ Risk :</strong>
                {{ $riskWinner=='A' ? $countryA : $countryB }}
                has lower supply chain risk.
            </li>

            <li>
                <strong>🌤 Weather :</strong>
                {{ $countryA }} : {{ $weatherTextA }},
                {{ $countryB }} : {{ $weatherTextB }}
            </li>

            <li>
                <strong>💱 Currency :</strong>
                {{ $dataA->currency_code }}
                vs
                {{ $dataB->currency_code }}
            </li>

        </ul>

    </div>

</div>

@endsection