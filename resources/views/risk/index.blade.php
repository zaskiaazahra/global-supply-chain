@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

{{-- =========================
SELECT COUNTRY
========================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-body">

        <form method="GET">

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
RISK SCORE
========================= --}}

<div class="row mb-4">

<div class="col-lg-6">

<div class="card border-0 shadow-sm h-100">

<div class="card-body text-center">

<h5 class="fw-bold">

⚠ Risk Score

</h5>

<h1
class="display-2 fw-bold
@if($riskLevel=='LOW')
text-success
@elseif($riskLevel=='MEDIUM')
text-warning
@else
text-danger
@endif">

{{ $totalRisk }}

</h1>

<h3>

{{ $riskLevel }}

</h3>

<div class="progress mt-4"
style="height:22px;">

<div
class="progress-bar
@if($riskLevel=='LOW')
bg-success
@elseif($riskLevel=='MEDIUM')
bg-warning
@else
bg-danger
@endif"

style="width:{{ $totalRisk }}%;">

{{ $totalRisk }}%

</div>

</div>

</div>

</div>

</div>

<div class="col-lg-6">

<div class="card border-0 shadow-sm h-100">

<div class="card-header bg-white fw-bold">

📊 Risk Components

</div>

<div class="card-body">

<table class="table">

<tr>

<td>🌦 Weather</td>

<td class="text-end">

{{ $weatherRisk }}

</td>

</tr>

<tr>

<td>📈 Inflation</td>

<td class="text-end">

{{ $inflationRisk }}

</td>

</tr>

<tr>

<td>💱 Currency</td>

<td class="text-end">

{{ $currencyRisk }}

</td>

</tr>

<tr>

<td>📰 News</td>

<td class="text-end">

{{ $newsRisk }}

</td>

</tr>

<tr class="table-light fw-bold">

<td>Total</td>

<td class="text-end">

{{ $totalRisk }}

</td>

</tr>

</table>

</div>

</div>

</div>

</div>

{{-- =========================
DETAIL INFORMATION
========================= --}}

<div class="row mb-4">

    {{-- Weather --}}
    <div class="col-lg-3 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">
                    🌦
                </div>

                <h5 class="mt-3">
                    Weather
                </h5>

                @if(isset($weather['current']['temperature_2m']))

                    <h3 class="fw-bold">

                        {{ round($weather['current']['temperature_2m']) }}°C

                    </h3>

                    <small class="text-muted">

                        Wind :
                        {{ round($weather['current']['wind_speed_10m']) }} km/h

                    </small>

                @else

                    <h3>N/A</h3>

                @endif

            </div>

        </div>

    </div>

    {{-- Inflation --}}
    <div class="col-lg-3 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">
                    📈
                </div>

                <h5 class="mt-3">
                    Inflation
                </h5>

                @if($inflation)

                    <h3 class="fw-bold">

                        {{ number_format($inflation['value'],2) }}%

                    </h3>

                    <small class="text-muted">

                        {{ $inflation['date'] }}

                    </small>

                @else

                    <h3>N/A</h3>

                @endif

            </div>

        </div>

    </div>

    {{-- Currency --}}
    <div class="col-lg-3 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">
                    💱
                </div>

                <h5 class="mt-3">
                    Currency
                </h5>

                @if($currency)

                    <h3 class="fw-bold">

                        {{ $currency['code'] }}

                    </h3>

                    <small class="text-muted">

                        {{ $currency['rate'] }}

                    </small>

                @else

                    <h3>N/A</h3>

                @endif

            </div>

        </div>

    </div>

    {{-- News --}}
    <div class="col-lg-3 mb-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body text-center">

                <div class="display-5">
                    📰
                </div>

                <h5 class="mt-3">
                    News
                </h5>

                <h3 class="fw-bold">

                    {{ count($articles) }}

                </h3>

                <small class="text-muted">

                    Latest Articles

                </small>

            </div>

        </div>

    </div>

</div>
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white fw-bold">

        😊 News Sentiment Analysis

    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-4">

                <h5 class="text-success">

                    {{ $sentiment['positive'] }}

                </h5>

                <small>

                    Positive Words

                </small>

            </div>

            <div class="col-md-4">

                <h5 class="text-danger">

                    {{ $sentiment['negative'] }}

                </h5>

                <small>

                    Negative Words

                </small>

            </div>

            <div class="col-md-4">

                @if($sentiment['sentiment']=="Positive")

                    <span class="badge bg-success fs-6">

                        Positive

                    </span>

                @elseif($sentiment['sentiment']=="Neutral")

                    <span class="badge bg-warning text-dark fs-6">

                        Neutral

                    </span>

                @else

                    <span class="badge bg-danger fs-6">

                        Negative

                    </span>

                @endif

            </div>

        </div>

    </div>

</div>
{{-- =========================
LATEST NEWS
========================= --}}

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white fw-bold">

        📰 Latest Headlines

    </div>

    <div class="card-body">

        <ul class="mb-0">

            @foreach(array_slice($articles,0,5) as $article)

                <li class="mb-2">

                    {{ $article['title'] }}

                </li>

            @endforeach

        </ul>

    </div>

</div>

{{-- =========================
RECOMMENDATION
========================= --}}

<div class="row mb-4">

    <div class="col-lg-12">

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white fw-bold">

                💡 Recommendation

            </div>

            <div class="card-body">

                @if($riskLevel == 'LOW')

                    <div class="alert alert-success">

                        <h5 class="fw-bold">

                            🟢 LOW RISK

                        </h5>

                        <ul class="mb-0">

                            <li>Safe for Import Activities</li>

                            <li>Continue shipment as planned</li>

                            <li>Monitor weather periodically</li>

                        </ul>

                    </div>

                @elseif($riskLevel == 'MEDIUM')

                    <div class="alert alert-warning">

                        <h5 class="fw-bold">

                            🟡 MEDIUM RISK

                        </h5>

                        <ul class="mb-0">

                            <li>Monitor exchange rate fluctuations</li>

                            <li>Review logistics schedule</li>

                            <li>Watch latest economic news</li>

                        </ul>

                    </div>

                @else

                    <div class="alert alert-danger">

                        <h5 class="fw-bold">

                            🔴 HIGH RISK

                        </h5>

                        <ul class="mb-0">

                            <li>Delay shipment if possible</li>

                            <li>Review supplier strategy</li>

                            <li>Monitor geopolitical conditions</li>

                            <li>Prepare alternative logistics routes</li>

                        </ul>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- =========================
RISK SUMMARY
========================= --}}

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white fw-bold">

        📋 Risk Summary

    </div>

    <div class="card-body">

        <div class="row text-center">

            <div class="col-md-3">

                <h6>Weather</h6>

                <span class="badge bg-primary">

                    {{ $weatherRisk }}

                </span>

            </div>

            <div class="col-md-3">

                <h6>Inflation</h6>

                <span class="badge bg-warning text-dark">

                    {{ $inflationRisk }}

                </span>

            </div>

            <div class="col-md-3">

                <h6>Currency</h6>

                <span class="badge bg-info">

                    {{ $currencyRisk }}

                </span>

            </div>

            <div class="col-md-3">

                <h6>News</h6>

                <span class="badge bg-danger">

                    {{ $newsRisk }}

                </span>

            </div>

        </div>

    </div>

</div>

</div>

@endsection