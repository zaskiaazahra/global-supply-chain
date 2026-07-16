@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

<!-- ========================= -->
<!-- SUMMARY -->
<!-- ========================= -->

<div class="row justify-content-center mb-4">

    <!-- Countries -->

    <div class="col-lg-4 col-md-4 mb-3">

        <div class="card shadow-sm border-0">

            <div class="card-body text-center">

                <i class="bi bi-globe2 fs-1"
                style="color:#8B5E3C;"></i>

                <h2 class="fw-bold mt-2">

                    {{ $totalCountries }}

                </h2>

                <p class="text-muted mb-0">

                    Countries

                </p>

            </div>

        </div>

    </div>

    <!-- Selected Country -->

    <div class="col-lg-4 col-md-4 mb-3">

        <div class="card shadow-sm border-0">

            <div class="card-body text-center">

    <img src="{{ $country->flag_url }}"
         width="45"
         class="mb-2">

    <h4 class="fw-bold">

        {{ $selected }}

    </h4>

    <p class="text-muted mb-1">

        {{ $country->region }}

    </p>

    <span class="badge"
          style="background:#8B5E3C;">

        Selected Country

    </span>

</div>
        </div>

    </div>

<!-- ========================= -->
<!-- GLOBAL COUNTRY -->
<!-- ========================= -->

<div class="row mb-4">

<div class="col-lg-6">

<div class="card shadow-sm border-0 h-100">

<div class="card-header"
style="background:#F8F5F1;">

<h5 class="fw-bold mb-0"
style="color:#6F4E37;">

🌍 Global Country Dashboard

</h5>

</div>

<div class="card-body">

<form method="GET">

<label class="fw-bold mb-2">

Select Country

</label>

<select
name="country"
class="form-select mb-4"
onchange="this.form.submit()">

@foreach($countries as $item)

<option
value="{{ $item->name }}"
{{ $selected==$item->name?'selected':'' }}>

{{ $item->name }}

</option>

@endforeach

</select>

</form>

<table class="table align-middle">

<tr>

<th width="45%">GDP</th>

<td>

{{ $gdp ? '$'.number_format($gdp['value']/1000000000000,2).' T' : '-' }}

</td>

</tr>

<tr>

<th>Inflation</th>

<td>

{{ $inflation ? number_format($inflation['value'],2).' %' : '-' }}

</td>

</tr>

<tr>

<th>Population</th>

<td>

{{ $population ? number_format($population['value']) : '-' }}

</td>

</tr>

<tr>

<th>Currency</th>

<td>

{{ $currency['code'] ?? '-' }}

</td>

</tr>

<tr>

<th>Current Weather</th>

<td>

{{ $weatherText }}

({{ $currentWeather['temperature_2m'] }} °C)

</td>

</tr>

</table>

</div>

</div>

</div>

<div class="col-lg-6">

<div class="card shadow-sm border-0 h-100">

<div class="card-header"
style="background:#F8F5F1;">

<h5 class="fw-bold mb-0"
style="color:#6F4E37;">

🌦 Current Weather

</h5>

</div>

<div class="card-body">

<table class="table align-middle">
<tr>

<th width="45%">Condition</th>

<td>

{{ $weatherText }}

</td>

</tr>

<tr>

<th>Temperature</th>

<td>

{{ $currentWeather['temperature_2m'] }} °C

</td>

</tr>

<tr>

<th>Humidity</th>

<td>

{{ $currentWeather['relative_humidity_2m'] }} %

</td>

</tr>

<tr>

<th>Wind Speed</th>

<td>

{{ $currentWeather['wind_speed_10m'] }} km/h

</td>

</tr>

</table>

</div>

</div>

</div>

</div>

@endsection