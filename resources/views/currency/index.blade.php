@extends('layouts.app')

@section('content')

@include('layouts.navbar')

@php

$idr = $currencies->firstWhere('currency_code','IDR');

@endphp

<div class="container-fluid px-4">

<!-- ========================================= -->
<!-- PAGE HEADER -->
<!-- ========================================= -->

<div class="d-flex justify-content-between align-items-start mb-4">

    <div>

        <h2 class="fw-bold mb-2">
            🌍 Global Currency
        </h2>

        <p class="text-muted mb-2">
            Real-time exchange rates for global trade and logistics.
        </p>

        <small class="text-muted">
            {{ now()->format('d F Y') }}
        </small>

    </div>

    <div class="text-end">

        <small class="text-muted d-block">
            Business Dashboard
        </small>

        <strong class="d-block">
            {{ now()->format('H:i') }}
        </strong>

    </div>

</div>

<!-- ========================================= -->
<!-- SUMMARY -->
<!-- ========================================= -->

<div class="row g-3 mb-4">

    <div class="col-lg-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center py-4">

                <div class="fs-2 mb-2">
                    💵
                </div>

                <h3 class="fw-bold mb-1">
                    USD
                </h3>

                <small class="text-muted">
                    Base Currency
                </small>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center py-4">

                <div class="fs-2 mb-2">
                    🌐
                </div>

                <h4 class="fw-bold mb-1 text-success">
                    Live Data
                </h4>

                <small class="text-muted">
                    Exchange Rate
                </small>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center py-4">

                <div class="fs-2 mb-2">
                    🕒
                </div>

                <h4 class="fw-bold mb-1">
                    {{ now()->format('H:i') }}
                </h4>

                <small class="text-muted">
                    Last Update
                </small>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center py-4">

                <div class="fs-2 mb-2">
                    🌍
                </div>

                <h3 class="fw-bold mb-1">
                    161+
                </h3>

                <small class="text-muted">
                    Currencies
                </small>

            </div>

        </div>

    </div>

</div>

<!-- ========================================= -->
<!-- CURRENT EXCHANGE RATES -->
<!-- ========================================= -->

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-0 py-4">

        <h5 class="fw-bold mb-3">

            💱 Current Exchange Rates

        </h5>

        <div style="max-width:520px;">

            <input
                type="text"
                id="currencySearch"
                class="form-control"
                placeholder="🔍 Search country or currency...">

        </div>

    </div>

    <div class="table-responsive">
    
    <table class="table table-hover align-middle mb-0">

    <thead style="background:#FCF8F3;">

        <tr>

            <th class="ps-4" style="width:45%;">
                Country / Currency
            </th>

            <th style="width:15%;">
                Code
            </th>

            <th class="text-end pe-4" style="width:40%;">
                Exchange Rate
            </th>

        </tr>

    </thead>

    <tbody id="currencyTable">

        <tr>

            <td class="ps-4">

                <div class="fw-semibold">

                    🇮🇩 Indonesia

                </div>

                <small class="text-muted">

                    Indonesian Rupiah

                </small>

            </td>

            <td>

                <span class="badge bg-light text-dark border">

                    IDR

                </span>

            </td>

            <td class="text-end pe-4 fw-semibold">

                Rp {{ number_format($idr->rate ?? 0,0,',','.') }}

            </td>

        </tr>

        <tr>

            <td class="ps-4">

                <div class="fw-semibold">

                    🇪🇺 European Union

                </div>

                <small class="text-muted">

                    Euro

                </small>

            </td>

            <td>

                <span class="badge bg-light text-dark border">

                    EUR

                </span>

            </td>

            <td class="text-end pe-4 fw-semibold">

                € {{ number_format($rates['EUR'],2) }}

            </td>

        </tr>

        <tr>

            <td class="ps-4">

                <div class="fw-semibold">

                    🇯🇵 Japan

                </div>

                <small class="text-muted">

                    Japanese Yen

                </small>

            </td>

            <td>

                <span class="badge bg-light text-dark border">

                    JPY

                </span>

            </td>

            <td class="text-end pe-4 fw-semibold">

                ¥ {{ number_format($rates['JPY'],2) }}

            </td>

        </tr>

        <tr>

            <td class="ps-4">

                <div class="fw-semibold">

                    🇬🇧 United Kingdom

                </div>

                <small class="text-muted">

                    British Pound

                </small>

            </td>

            <td>

                <span class="badge bg-light text-dark border">

                    GBP

                </span>

            </td>

            <td class="text-end pe-4 fw-semibold">

                £ {{ number_format($rates['GBP'],2) }}

            </td>

        </tr>

        <tr>

            <td class="ps-4">

                <div class="fw-semibold">

                    🇸🇬 Singapore

                </div>

                <small class="text-muted">

                    Singapore Dollar

                </small>

            </td>

            <td>

                <span class="badge bg-light text-dark border">

                    SGD

                </span>

            </td>

            <td class="text-end pe-4 fw-semibold">

                S$ {{ number_format($rates['SGD'],2) }}

            </td>

        </tr>

        <tr>

            <td class="ps-4">

                <div class="fw-semibold">

                    🇨🇳 China

                </div>

                <small class="text-muted">

                    Chinese Yuan

                </small>

            </td>

            <td>

                <span class="badge bg-light text-dark border">

                    CNY

                </span>

            </td>

            <td class="text-end pe-4 fw-semibold">

                ¥ {{ number_format($rates['CNY'],2) }}

            </td>

        </tr>

        <tr>

            <td class="ps-4">

                <div class="fw-semibold">

                    🇲🇾 Malaysia

                </div>

                <small class="text-muted">

                    Malaysian Ringgit

                </small>

            </td>

            <td>

                <span class="badge bg-light text-dark border">

                    MYR

                </span>

            </td>

            <td class="text-end pe-4 fw-semibold">

                RM {{ number_format($rates['MYR'],2) }}

            </td>

        </tr>

    </tbody>

</table>

</div>

</div>

<style>

.table td{

    padding:16px 18px;

    vertical-align:middle;

}

.table tbody tr{

    transition:.2s;

}

.table tbody tr:hover{

    background:#FFF8F2;

}

.badge.bg-light{

    background:#F7F7F7 !important;

    border-radius:20px;

    font-weight:600;

}

#currencySearch{

    border:1px solid #ddd;

    border-radius:12px;

    box-shadow:none;

    transition:.3s;

}

#currencySearch:focus{

    border-color:#8B5E3C;

    box-shadow:0 0 0 .15rem rgba(139,94,60,.15);

}

</style>

<!-- ========================================= -->
<!-- CHART & CONVERTER -->
<!-- ========================================= -->

<div class="row mb-4">

    <!-- Exchange Chart -->

    <div class="col-lg-7">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold mb-0">

                    📈 Exchange Rate Trend

                </h5>

            </div>

            <div class="card-body">

                <canvas id="currencyChart" height="90"></canvas>

            </div>

        </div>

    </div>

    <!-- Converter -->

    <div class="col-lg-5">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 pt-4">

                <h5 class="fw-bold mb-0">

                    💱 Currency Converter

                </h5>

            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">

                        Amount

                    </label>

                    <input
                        type="number"
                        id="usd"
                        class="form-control"
                        value="1">

                </div>

                <div class="text-center my-3">

                    <i class="bi bi-arrow-down-circle-fill text-secondary fs-4"></i>

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Indonesian Rupiah (IDR)

                    </label>

                    <input
                        type="text"
                        id="idr"
                        class="form-control fw-semibold"
                        readonly>

                </div>

                <hr>

                <small class="text-muted">

                    Current Rate

                </small>

                <h5 class="fw-bold mt-2">

                    Rp {{ number_format($idr->rate ?? 0,0,',','.') }}

                </h5>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const rate={{ $idr->rate ?? 0 }};

const usd=document.getElementById('usd');

const idr=document.getElementById('idr');

function convert(){

    idr.value="Rp "+(usd.value*rate).toLocaleString('id-ID');

}

convert();

usd.addEventListener('keyup',convert);

usd.addEventListener('change',convert);

new Chart(document.getElementById('currencyChart'),{

    type:'line',

    data:{

        labels:['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],

        datasets:[{

            data:[17820,17835,17850,17870,17890,17910,{{ $idr->rate ?? 0 }}],

            borderColor:'#8B5E3C',

            borderWidth:3,

            pointRadius:4,

            pointBackgroundColor:'#8B5E3C',

            fill:false,

            tension:.35

        }]

    },

    options:{

        plugins:{

            legend:{

                display:false

            }

        },

        responsive:true,

        maintainAspectRatio:false

    }

});

</script>
<!-- ========================================= -->
<!-- CURRENCY INFORMATION -->
<!-- ========================================= -->

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-0 pt-4">

        <h5 class="fw-bold mb-0">

            📊 Currency Information

        </h5>

    </div>

    <div class="card-body">

        <div class="row g-3">

            <div class="col-lg-3 col-md-6">

                <div class="border rounded-3 p-3 h-100">

                    <div class="d-flex align-items-center mb-2">

                        <span class="fs-4 me-2">💵</span>

                        <strong>USD</strong>

                    </div>

                    <small class="text-muted">

                        Global reserve currency used in international trade.

                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="border rounded-3 p-3 h-100">

                    <div class="d-flex align-items-center mb-2">

                        <span class="fs-4 me-2">🇪🇺</span>

                        <strong>EUR</strong>

                    </div>

                    <small class="text-muted">

                        Official currency across most European Union countries.

                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="border rounded-3 p-3 h-100">

                    <div class="d-flex align-items-center mb-2">

                        <span class="fs-4 me-2">🇨🇳</span>

                        <strong>CNY</strong>

                    </div>

                    <small class="text-muted">

                        Widely used in Asian manufacturing and export markets.

                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="border rounded-3 p-3 h-100">

                    <div class="d-flex align-items-center mb-2">

                        <span class="fs-4 me-2">🇮🇩</span>

                        <strong>IDR</strong>

                    </div>

                    <small class="text-muted">

                        Official currency used for domestic transactions in Indonesia.

                    </small>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Search -->

<script>

const search = document.getElementById('currencySearch');

if(search){

    search.addEventListener('keyup', function(){

        let value = this.value.toLowerCase();

        let rows = document.querySelectorAll('#currencyTable tr');

        rows.forEach(function(row){

            row.style.display = row.innerText.toLowerCase().includes(value)
                ? ''
                : 'none';

        });

    });

}
</script>

<style>

#currencySearch{

    border:1px solid #ddd;

    border-radius:12px;

    box-shadow:none;

    transition:.25s;

}

#currencySearch:focus{

    border-color:#8B5E3C;

    box-shadow:0 0 0 .15rem rgba(139,94,60,.15);

}

.table td{

    padding:16px 18px;

    vertical-align:middle;

}

.table tbody tr:hover{

    background:#FFF8F2;

}

.badge.bg-light{

    background:#F8F8F8 !important;

    border-radius:20px;

    font-weight:600;

}

.card{

    border-radius:14px;

}

</style>

@endsection