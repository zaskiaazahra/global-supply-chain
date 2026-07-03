@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

    <!-- SUMMARY CARD -->
    <div class="row mb-4">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-globe2 summary-icon fs-1"></i>
                    <div class="summary-number">{{ $totalCountries }}</div>
                    <small class="text-muted">Countries</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam summary-icon fs-1"></i>
                    <div class="summary-number">0</div>
                    <small class="text-muted">Active Shipment</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-exclamation-triangle summary-icon fs-1"></i>
                    <div class="summary-number">Low</div>
                    <small class="text-muted">Risk Score</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="bi bi-currency-dollar summary-icon fs-1"></i>
                    <div class="summary-number">--</div>
                    <small class="text-muted">USD / IDR</small>
                </div>
            </div>
        </div>

    </div>

    <!-- ROW 2 -->
    <div class="row mb-4">

        <div class="col-lg-8 mb-3">

            <div class="card h-100">

                <div class="card-header">
                    🚢 Live Shipment Tracking
                </div>

                <div class="card-body">

                    <div id="shipmentMap" style="height:350px;border-radius:12px;"></div>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-3">

            <div class="card h-100">

                <div class="card-header">
                    📈 Exchange Rate Trend
                </div>

                <div class="card-body">

                    <canvas id="exchangeChart"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- ROW 3 -->
    <div class="row mb-4">

        <div class="col-lg-6 mb-3">

            <div class="card">

                <div class="card-header">
                    🌍 Country Overview
                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Select a country to display economy, weather, currency and political information.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-3">

            <div class="card">

                <div class="card-header">
                    🌦 Weather Alert
                </div>

                <div class="card-body">

                    <p class="text-muted">
                        No weather alerts available.
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- ROW 4 -->
    <div class="row">

        <div class="col-lg-6 mb-3">

            <div class="card">

                <div class="card-header">
                    📰 Latest Global News
                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Global trade news will appear here.
                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-6 mb-3">

            <div class="card">

                <div class="card-header">
                    ⚠ Risk Analysis
                </div>

                <div class="card-body">

                    <p class="text-muted">
                        Risk analysis based on weather, exchange rate and news.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('exchangeChart');

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


// =======================
// LEAFLET MAP
// =======================

var map = L.map('shipmentMap').setView([-2.5,118],5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{

    attribution:'© OpenStreetMap'

}).addTo(map);


// Marker

L.marker([-6.2088,106.8456])
.addTo(map)
.bindPopup('Jakarta Port');

L.marker([1.3521,103.8198])
.addTo(map)
.bindPopup('Singapore Port');

L.marker([31.2304,121.4737])
.addTo(map)
.bindPopup('Shanghai Port');


// Route

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