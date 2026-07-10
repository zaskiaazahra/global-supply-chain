@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

{{-- =========================
    SELECT COUNTRY
========================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form method="GET" action="{{ route('economy') }}">

            <label class="fw-bold mb-2">
                🌍 Select Country
            </label>

            <select
                class="form-select"
                name="country"
                onchange="this.form.submit()">

                @foreach($countries as $item)

                    <option
                        value="{{ $item->name }}"
                        {{ $selected == $item->name ? 'selected' : '' }}>

                        {{ $item->name }}

                    </option>

                @endforeach

            </select>

        </form>

    </div>

</div>

{{-- =========================
    COUNTRY INFORMATION
========================= --}}

@if($countryInfo)

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white fw-bold">

        🌍 Country Information

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <strong>Country</strong><br>

                {{ $countryInfo['name'] }}

            </div>

            <div class="col-md-4 mb-3">

                <strong>Capital</strong><br>

                {{ $countryInfo['capitalCity'] ?: '-' }}

            </div>

            <div class="col-md-4 mb-3">

                <strong>Region</strong><br>

                {{ $countryInfo['region']['value'] }}

            </div>

            <div class="col-md-4">

                <strong>Income Level</strong><br>

                {{ $countryInfo['incomeLevel']['value'] }}

            </div>

            <div class="col-md-4">

                <strong>ISO Code</strong><br>

                {{ $countryInfo['id'] }}

            </div>

            <div class="col-md-4">

                <strong>Longitude</strong><br>

                {{ $countryInfo['longitude'] }}

            </div>

        </div>

    </div>

</div>

@endif

{{-- =========================
    ECONOMY CARDS
========================= --}}

<div class="row mb-4">

    {{-- GDP --}}
    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">💰</div>

                <h6 class="text-muted mt-2">GDP</h6>

                @if($gdp)

                    <h3 class="fw-bold text-success">
                        ${{ number_format($gdp['value']/1000000000000,2) }} T
                    </h3>

                    <small class="text-muted">
                        {{ $gdp['date'] }}
                    </small>

                @else

                    <h3 class="fw-bold text-secondary">
                        N/A
                    </h3>

                    <small class="text-danger">
                        Data unavailable
                    </small>

                @endif

            </div>

        </div>

    </div>

    {{-- Population --}}
    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">👨‍👩‍👧‍👦</div>

                <h6 class="text-muted mt-2">
                    Population
                </h6>

                @if($population)

                    <h3 class="fw-bold">
                        {{ number_format($population['value']/1000000,1) }} M
                    </h3>

                    <small class="text-muted">
                        {{ $population['date'] }}
                    </small>

                @else

                    <h3 class="fw-bold text-secondary">
                        N/A
                    </h3>

                    <small class="text-danger">
                        Data unavailable
                    </small>

                @endif

            </div>

        </div>

    </div>

    {{-- Inflation --}}
    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">📉</div>

                <h6 class="text-muted mt-2">
                    Inflation
                </h6>

                @if($inflation)

                    <h3 class="fw-bold text-danger">
                        {{ number_format($inflation['value'],2) }}%
                    </h3>

                    <small class="text-muted">
                        {{ $inflation['date'] }}
                    </small>

                @else

                    <h3 class="fw-bold text-secondary">
                        N/A
                    </h3>

                    <small class="text-danger">
                        Data unavailable
                    </small>

                @endif

            </div>

        </div>

    </div>

    {{-- Export --}}
    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">📦</div>

                <h6 class="text-muted mt-2">
                    Export
                </h6>

                @if($export)

                    <h3 class="fw-bold">
                        ${{ number_format($export['value']/1000000000,1) }} B
                    </h3>

                    <small class="text-muted">
                        {{ $export['date'] }}
                    </small>

                @else

                    <h3 class="fw-bold text-secondary">
                        N/A
                    </h3>

                    <small class="text-danger">
                        Data unavailable
                    </small>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- =========================
    TRADE BALANCE & SUMMARY
========================= --}}

<div class="row mb-4">

    {{-- Trade Balance --}}
    <div class="col-lg-6 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center d-flex flex-column justify-content-center">

                <div class="display-4 mb-3">
                    ⚖️
                </div>

                <h5 class="fw-bold">
                    Trade Balance
                </h5>

                @if($tradeBalance !== null)

                    @if($tradeBalance >= 0)

                        <h2 class="fw-bold text-success mt-3">
                            +${{ number_format($tradeBalance/1000000000,1) }} B
                        </h2>

                        <span class="badge bg-success px-3 py-2 mt-2">
                            Trade Surplus
                        </span>

                    @else

                        <h2 class="fw-bold text-danger mt-3">
                            -${{ number_format(abs($tradeBalance)/1000000000,1) }} B
                        </h2>

                        <span class="badge bg-danger px-3 py-2 mt-2">
                            Trade Deficit
                        </span>

                    @endif

                @else

                    <h3 class="text-secondary mt-3">
                        N/A
                    </h3>

                @endif

            </div>

        </div>

    </div>

    {{-- Economy Summary --}}
    <div class="col-lg-6 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white fw-bold">

                📊 Economy Summary

            </div>

            <div class="card-body">

                <table class="table table-borderless mb-0">

                    <tr>
                        <td><strong>GDP</strong></td>
                        <td class="text-end">
                            {{ $gdp ? '$'.number_format($gdp['value']/1000000000000,2).' T' : 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Population</strong></td>
                        <td class="text-end">
                            {{ $population ? number_format($population['value']/1000000,1).' M' : 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Inflation</strong></td>
                        <td class="text-end">
                            {{ $inflation ? number_format($inflation['value'],2).'%' : 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Export</strong></td>
                        <td class="text-end">
                            {{ $export ? '$'.number_format($export['value']/1000000000,1).' B' : 'N/A' }}
                        </td>
                    </tr>

                    <tr>
                        <td><strong>Import</strong></td>
                        <td class="text-end">
                            {{ $import ? '$'.number_format($import['value']/1000000000,1).' B' : 'N/A' }}
                        </td>
                    </tr>

                    <tr class="border-top">

                        <td><strong>Trade Balance</strong></td>

                        <td class="text-end">

                            @if($tradeBalance !== null)

                                @if($tradeBalance >= 0)

                                    <span class="text-success fw-bold">
                                        +${{ number_format($tradeBalance/1000000000,1) }} B
                                    </span>

                                @else

                                    <span class="text-danger fw-bold">
                                        -${{ number_format(abs($tradeBalance)/1000000000,1) }} B
                                    </span>

                                @endif

                            @else

                                N/A

                            @endif

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

{{-- =========================
    CHARTS
========================= --}}

<div class="row">

    {{-- GDP Trend --}}
    <div class="col-lg-6 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white fw-bold">

                📈 GDP Trend

            </div>

            <div class="card-body">

                <div style="height:300px">

                    <canvas id="gdpChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    {{-- Export vs Import --}}
    <div class="col-lg-6 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white fw-bold">

                📦 Export vs Import

            </div>

            <div class="card-body d-flex justify-content-center align-items-center">

                <div style="width:260px;height:260px;">

                    <canvas id="tradeChart"></canvas>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- =========================
    ECONOMY INSIGHT
========================= --}}

<div class="row mb-4">

    <div class="col-lg-12">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white fw-bold">

                💡 Economy Insight

            </div>

            <div class="card-body">

                @if(count($insights))

                    <ul class="mb-0">

                        @foreach($insights as $item)

                            <li class="mb-2">

                                {{ $item }}

                            </li>

                        @endforeach

                    </ul>

                @else

                    <p class="text-muted mb-0">

                        No insight available.

                    </p>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- =========================
    ECONOMIC STATUS
========================= --}}

<div class="row mb-4">

    <div class="col-lg-12">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white fw-bold">

                📊 Economic Status

            </div>

            <div class="card-body">

                <div class="row text-center">

                    <div class="col-md-3 mb-3">

                        <h6>Economy</h6>

                        <span class="badge bg-success px-3 py-2">

                            {{ $status['economy'] }}

                        </span>

                    </div>

                    <div class="col-md-3 mb-3">

                        <h6>Inflation</h6>

                        <span class="badge bg-warning text-dark px-3 py-2">

                            {{ $status['inflation'] }}

                        </span>

                    </div>

                    <div class="col-md-3 mb-3">

                        <h6>Trade</h6>

                        <span class="badge bg-primary px-3 py-2">

                            {{ $status['trade'] }}

                        </span>

                    </div>

                    <div class="col-md-3 mb-3">

                        <h6>Population</h6>

                        <span class="badge bg-secondary px-3 py-2">

                            {{ $status['population'] }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- =========================
    CHART JS
========================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const gdpCtx = document.getElementById('gdpChart');

if(gdpCtx){

new Chart(gdpCtx,{

type:'line',

data:{

labels:[

@foreach($gdpHistory as $item)

'{{ $item['year'] }}',

@endforeach

],

datasets:[{

label:'GDP (Trillion USD)',

data:[

@foreach($gdpHistory as $item)

{{ $item['value'] }},

@endforeach

],

borderColor:'#8B5E3C',

backgroundColor:'rgba(166,124,82,.15)',

fill:true,

tension:.4

}]

},

options:{

responsive:true,

maintainAspectRatio:false,

plugins:{

legend:{

display:false

}

}

}

});

}

const tradeCtx = document.getElementById('tradeChart');

if(tradeCtx){

new Chart(tradeCtx,{

type:'doughnut',

data:{

labels:['Export','Import'],

datasets:[{

data:[

{{ $export ? round($export['value']/1000000000,2) : 0 }},

{{ $import ? round($import['value']/1000000000,2) : 0 }}

],

backgroundColor:[

'#8B5E3C',

'#D2B48C'

],

borderWidth:0

}]

},

options:{

responsive:true,

maintainAspectRatio:false,

cutout:'65%',

plugins:{

legend:{

position:'bottom'

}

}

}

});

}

</script>

</div>

@endsection