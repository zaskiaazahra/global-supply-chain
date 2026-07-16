@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

<div class="mb-4">

<h2 class="fw-bold">

📊 Data Visualization Dashboard

</h2>

<p class="text-muted">

Visualization of GDP, Inflation, Currency Exchange, and Supply Chain Risk Trends.

</p>

</div>
<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <div class="row align-items-end">

    <div class="col-md-9">

        <form method="GET">

            <label class="fw-bold mb-2">

                🌍 Select Country

            </label>

            <select
                name="country"
                class="form-select"
                onchange="this.form.submit()">

                @foreach($countries as $country)

                    <option
                        value="{{ $country->name }}"
                        {{ $selected==$country->name?'selected':'' }}>

                        {{ $country->name }}

                    </option>

                @endforeach

            </select>

        </form>

    </div>

    <div class="col-md-3">

        <form
            action="{{ route('watchlist.store') }}"
            method="POST">

            @csrf

            <input
                type="hidden"
                name="country"
                value="{{ $selected }}">

            <button
                type="submit"
                class="btn w-100"
                style="background:#8B5E3C;color:white;">

                👁 Add to Watchlist

            </button>

        </form>

    </div>

</div>
    </div>

</div>
<div class="row">

<!-- GDP -->

<div class="col-lg-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-header bg-white d-flex justify-content-between align-items-center">

    <h5 class="fw-bold mb-0">

        📈 GDP Trend

    </h5>

    <span
class="badge"
style="background:#8B5E3C;color:white;">

    🌍 {{ $selected }}

</span>

</div>
<div class="card-body">

<div style="height:300px">

<canvas id="gdpChart"></canvas>

</div>

</div>

</div>

</div>

<!-- Inflation -->

<div class="col-lg-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-header bg-white d-flex justify-content-between align-items-center">

    <h5 class="fw-bold mb-0">

        📉 Inflation Trend

    </h5>

    <span
class="badge"
style="background:#8B5E3C;color:white;">

    🌍 {{ $selected }}

</span>

</div>

<div class="card-body">

<div style="height:300px">

<canvas id="inflationChart"></canvas>

</div>

</div>

</div>

</div>

<!-- Currency -->

<div class="col-lg-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-header bg-white d-flex justify-content-between align-items-center">

    <h5 class="fw-bold mb-0">

        💱 Currency Trend

    </h5>

    <span
class="badge"
style="background:#8B5E3C;color:white;">

    🌍 {{ $selected }}

</span>

</div>

<div class="card-body">

<div style="height:300px">

<canvas id="currencyChart"></canvas>

</div>

</div>

</div>

</div>

<!-- Risk -->

<div class="col-lg-6 mb-4">

<div class="card shadow-sm border-0 h-100">

<div class="card-header bg-white d-flex justify-content-between align-items-center">

    <h5 class="fw-bold mb-0">

        ⚠ Supply Chain Risk Trend

    </h5>

    <span
class="badge"
style="background:#8B5E3C;color:white;">

    🌍 {{ $selected }}

</span>

</div>

<div class="card-body">

<div style="height:300px">

<canvas id="riskChart"></canvas>

</div>

</div>

</div>

</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const labels = [
    '2018',
    '2019',
    '2020',
    '2021',
    '2022',
    '2023',
    '2024'
];

const chartOptions = {

    responsive:true,

    maintainAspectRatio:false,

    plugins:{
        legend:{
            display:false
        }
    },

    scales:{
        y:{
            beginAtZero:false,
            grid:{
                color:'#ececec'
            }
        },
        x:{
            grid:{
                display:false
            }
        }
    }

};

// ================= GDP =================

new Chart(document.getElementById('gdpChart'),{

    type:'line',

    data:{

        labels:labels,

        datasets:[{

            data:@json($gdpTrend),

            borderColor:'#8B5E3C',

            backgroundColor:'rgba(139,94,60,.15)',

            fill:true,

            tension:.4,

            pointRadius:5,

            pointHoverRadius:7

        }]

    },

    options:chartOptions

});

// ================= Inflation =================

new Chart(document.getElementById('inflationChart'),{

    type:'line',

    data:{

        labels:labels,

        datasets:[{

            data:@json($inflationTrend),

            borderColor:'#E67E22',

            backgroundColor:'rgba(230,126,34,.15)',

            fill:true,

            tension:.4,

            pointRadius:5,

            pointHoverRadius:7

        }]

    },

    options:chartOptions

});

// ================= Currency =================

new Chart(document.getElementById('currencyChart'),{

    type:'line',

    data:{

        labels:labels,

        datasets:[{

            data:@json($currencyTrend),

            borderColor:'#3498DB',

            backgroundColor:'rgba(52,152,219,.15)',

            fill:true,

            tension:.4,

            pointRadius:5,

            pointHoverRadius:7

        }]

    },

    options:chartOptions

});

// ================= Risk =================

new Chart(document.getElementById('riskChart'),{

    type:'line',

    data:{

        labels:labels,

        datasets:[{

            data:@json($riskTrend),

            borderColor:'#E74C3C',

            backgroundColor:'rgba(231,76,60,.15)',

            fill:true,

            tension:.4,

            pointRadius:5,

            pointHoverRadius:7

        }]

    },

    options:chartOptions

});

</script>

<style>

.card{

    border-radius:18px;

}

.card-header{

    border-radius:18px 18px 0 0 !important;

}

.card-body{

    padding:24px;

}

canvas{

    width:100% !important;

    height:100% !important;

}

</style>

@endsection