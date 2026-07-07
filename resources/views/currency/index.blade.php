@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
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
    
   <table id="currencyTable" class="table table-hover align-middle mb-0">

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

   <tbody>

@foreach($currencies as $currency)

<tr>

    <td>

<div class="d-flex align-items-center">

<img
src="{{ $currency->flag_url }}"
width="32"
height="22"
class="rounded border me-3">

<div>

<div class="fw-semibold">

{{ $currency->name }}

</div>

<small class="text-muted">

{{ $currency->currency_name }}

</small>

</div>

</div>

</td>

    <td>

        <span class="badge bg-light text-dark border">

            {{ $currency->currency_code }}

        </span>

    </td>

    <td class="text-end pe-4 fw-semibold">

        {{ number_format($currency->rate,2) }}

    </td>

</tr>

@endforeach

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

    <!-- ========================= -->
<!-- CURRENCY CONVERTER -->
<!-- ========================= -->

<div class="col-lg-5">

    <div class="card converter-card border-0 shadow-sm h-100">

        <div class="card-header bg-white border-0 pt-4">

            <h5 class="fw-bold mb-0">
                💱 Currency Converter
            </h5>

        </div>

        <div class="card-body">

            <!-- Currency -->
            <div class="row align-items-end">

                <!-- From -->
                <div class="col-5">

                    <label class="form-label fw-semibold">
                        From
                    </label>

                    <select
                        id="fromCurrency"
                        class="form-select shadow-sm converter-select">

                        @foreach($currencies as $currency)

                            <option
                                value="{{ $currency->currency_code }}"
                                {{ $currency->currency_code == 'USD' ? 'selected' : '' }}>

                                {{ $currency->currency_code }} - {{ $currency->currency_name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Swap -->
                <div class="col-2 text-center">

                    <button
                        id="swapCurrency"
                        type="button"
                        class="btn btn-light border shadow-sm rounded-circle swap-btn">

                        ⇄

                    </button>

                </div>

                <!-- To -->
                <div class="col-5">

                    <label class="form-label fw-semibold">
                        To
                    </label>

                    <select
                        id="toCurrency"
                        class="form-select shadow-sm converter-select">

                        @foreach($currencies as $currency)

                            <option
                                value="{{ $currency->currency_code }}"
                                {{ $currency->currency_code == 'IDR' ? 'selected' : '' }}>

                                {{ $currency->currency_code }} • {{ $currency->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

            <hr>

            <div class="text-center">

                <small class="text-muted d-block mb-2">
                    Converted Amount
                </small>

                <h2
                    id="conversionResult"
                    class="fw-bold">

                    Rp 18.016,47

                </h2>

            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>


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

<div class="card border-0 shadow-sm mb-4 mt-4">

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

<script>
const currencySymbols = {

    IDR: "Rp",
    USD: "$",
    EUR: "€",
    GBP: "£",
    JPY: "¥",
    CNY: "¥",
    SGD: "S$",
    MYR: "RM",
    KRW: "₩",
    THB: "฿",
    VND: "₫",
    PHP: "₱",
    INR: "₹",
    AUD: "A$",
    CAD: "C$",
    CHF: "CHF"

};
const exchangeRates = {

@foreach($currencies as $currency)

'{{ $currency->currency_code }}': {{ $currency->rate }},

@endforeach

};

const amountInput = document.getElementById('amount');

const fromCurrency = document.getElementById('fromCurrency');

const toCurrency = document.getElementById('toCurrency');

const result = document.getElementById('conversionResult');

function convertCurrency(){
    console.log("MASUK FUNCTION");
    const amount = parseFloat(amountInput.value) || 0;

    const fromRate = exchangeRates[fromCurrency.value];

    const toRate = exchangeRates[toCurrency.value];

    const usd = amount / fromRate;

    const converted = usd * toRate;

    try{

    if(toCurrency.value === "IDR"){

    result.innerHTML =
        "Rp " +
        converted.toLocaleString('id-ID',{

            minimumFractionDigits:2,
            maximumFractionDigits:2

        });

}else{

    result.innerHTML =
        new Intl.NumberFormat('en',{

            style:'currency',
            currency:toCurrency.value

        }).format(converted);

}

}catch(e){

    result.innerHTML =
    toCurrency.value + " " +
    converted.toLocaleString('id-ID',{

        minimumFractionDigits:2,
        maximumFractionDigits:2

    });

}
}

if(amountInput && fromCurrency && toCurrency){

    amountInput.addEventListener('input', convertCurrency);

    fromCurrency.addEventListener('change', convertCurrency);

    toCurrency.addEventListener('change', convertCurrency);

    convertCurrency();

}

const swapBtn = document.getElementById('swapCurrency');

if(swapBtn){

    swapBtn.addEventListener('click', function(){

        let temp = fromCurrency.value;

        fromCurrency.value = toCurrency.value;

        toCurrency.value = temp;

        convertCurrency();

    });

}

</script>
 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>

$(document).ready(function () {

    const table = $('#currencyTable').DataTable({

        pageLength:5,

        lengthMenu:[
            [5,10,25,50],
            [5,10,25,50]
        ],

        info:false

    });

    // sembunyikan search bawaan
    $('#currencyTable_filter').hide();

    // search dari textbox kita
    $('#currencySearch').on('keyup', function(){

        table.search($(this).val()).draw();

    });

});

</script>
<style>
.converter-select{

    height:48px;

    border-radius:12px;

    font-size:14px;

    font-weight:600;

    white-space:nowrap;

    overflow:hidden;

    text-overflow:ellipsis;

}
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
/* ========================= */
/* CONVERTER */
/* ========================= */

.converter-card{

    border-radius:18px;

    overflow:hidden;

}

.converter-select{

    height:48px;

    border-radius:12px;

    font-weight:600;

}

.converter-select option{

    font-weight:500;

}

.swap-btn{

    width:48px;

    height:48px;

    transition:.3s;

    font-size:20px;

}

.swap-btn:hover{

    background:#8B5E3C;

    color:#fff;

    transform:rotate(180deg);

}

#amount{

    height:48px;

    border-radius:12px;

}

#conversionResult{

    font-size:34px;

    color:#8B5E3C;

    letter-spacing:.5px;

}

</style>

@endsection