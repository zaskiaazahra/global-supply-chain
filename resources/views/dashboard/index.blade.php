@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

<!-- ========================= -->
<!-- SUMMARY CARD -->
<!-- ========================= -->

<div class="row mb-4">

    <!-- Countries -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <i class="bi bi-globe2 summary-icon fs-1"></i>

                <div class="summary-number">

                    {{ $totalCountries }}

                </div>

                <small class="text-muted">

                    Countries

                </small>

            </div>

        </div>

    </div>

    <!-- Shipment -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <i class="bi bi-box-seam summary-icon fs-1"></i>

                <div class="summary-number">

                    0

                </div>

                <small class="text-muted">

                    Active Shipment

                </small>

            </div>

        </div>

    </div>

    <!-- Risk -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <i class="bi bi-exclamation-triangle summary-icon fs-1"></i>

                <div class="summary-number text-success">

                    Low

                </div>

                <small class="text-muted">

                    Risk Score

                </small>

            </div>

        </div>

    </div>

    <!-- Currency -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="card shadow-sm">

            <div class="card-body text-center">

                <i class="bi bi-currency-dollar summary-icon fs-1"></i>

                @if(isset($exchangeRate['IDR']))

                    <div class="summary-number">

                        Rp {{ number_format($exchangeRate['IDR'],0,',','.') }}

                    </div>

                @else

                    <div class="summary-number text-danger">

                        API Error

                    </div>

                @endif

                <small class="text-muted">

                    Live USD / IDR

                </small>

            </div>

        </div>

    </div>

</div>

<!-- ========================= -->
<!-- MAP -->
<!-- ========================= -->

<div class="row mb-4">

<div class="col-lg-8">

<div class="card shadow-sm h-100">

<div class="card-header">

🚢 Live Shipment Tracking

</div>

<div class="card-body">

<div id="shipmentMap"

style="height:360px;border-radius:12px;">

</div>

</div>

</div>

</div>

<!-- EXCHANGE -->

<div class="col-lg-4">

<div class="card shadow-sm h-100">

<div class="card-header">

📈 Exchange Rate Trend

</div>

<div class="card-body">

<canvas id="exchangeChart"></canvas>

</div>

</div>

</div>

</div>

<!-- ========================= -->
<!-- COUNTRY -->
<!-- ========================= -->

<div class="row mb-4">

<div class="col-lg-6">

<div class="card shadow-sm">

<div class="card-header">

🌍 Country Overview

</div>

<div class="card-body">

<p class="text-muted">

Select a country to display GDP,
Inflation, Weather,
Currency and Economy.

</p>

</div>

</div>

</div>
        <div class="col-lg-6">

<div class="card shadow-sm">

<div class="card-header">

🌦 Weather Alert

</div>

<div class="card-body">

@if(isset($weather))

<div class="row text-center">

<div class="col-6 mb-3">

<h6>🌡 Temperature</h6>

<h4 class="fw-bold">

{{ $currentWeather['temperature_2m'] }}
</h4>

</div>

<div class="col-6 mb-3">

<h6>💨 Wind</h6>

<h4 class="fw-bold">

{{ $currentWeather['wind_speed_10m'] }}
</h4>

</div>

<div class="col-6">

<h6>💧 Humidity</h6>

<h4 class="fw-bold">

{{ $currentWeather['relative_humidity_2m'] }} %

</h4>

</div>

<div class="col-6">

<h6>☁ Weather Code</h6>

<h4 class="fw-bold">

{{ $currentWeather['weather_code'] }}

</h4>

</div>

</div>

@else

<p class="text-danger">

Weather data unavailable.

</p>

@endif

</div>

</div>

</div>

</div>

<!-- ========================= -->
<!-- NEWS & RISK -->
<!-- ========================= -->

<div class="row">

<div class="col-lg-6">

<div class="card shadow-sm">

<div class="card-header">

📰 Latest Global News

</div>

<div class="card-body">

<p class="text-muted">

News API will be integrated here.

</p>

</div>

</div>

</div>

<div class="col-lg-6">

<div class="card shadow-sm">

<div class="card-header">

⚠ Risk Analysis

</div>

<div class="card-body">

<div class="alert alert-success">

Current Supply Chain Risk

<br><br>

<strong>

LOW

</strong>

</div>

<p class="text-muted">

Risk Analysis will combine

Weather,

Currency,

Economy

and

News API.

</p>

</div>

</div>

</div>

</div>

</div>

<!-- ========================= -->
<!-- CHART -->
<!-- ========================= -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('exchangeChart');

new Chart(ctx,{

type:'line',

data:{

labels:['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],

datasets:[{

data:[16350,16320,16380,16410,16390,16420,16400],

borderColor:'#A67C52',

fill:false,

tension:.4

}]

},

options:{

plugins:{

legend:{

display:false

}

},

responsive:true

}

});

</script>

<!-- ========================= -->
<!-- LEAFLET -->
<!-- ========================= -->

<script>

var map=L.map('shipmentMap').setView([-2.5,118],5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{

attribution:'© OpenStreetMap'

}).addTo(map);

L.marker([-6.2088,106.8456])

.addTo(map)

.bindPopup('Jakarta Port');

L.marker([1.3521,103.8198])

.addTo(map)

.bindPopup('Singapore Port');

L.marker([31.2304,121.4737])

.addTo(map)

.bindPopup('Shanghai Port');

var route=[

[-6.2088,106.8456],

[1.3521,103.8198],

[31.2304,121.4737]

];

L.polyline(route,{

color:'#A67C52',

weight:4

}).addTo(map);

</script>

@endsection