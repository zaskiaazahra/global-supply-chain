@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
@section('content')

@php

if (!function_exists('weatherStatus')) {

    function weatherStatus($code)
    {
        return match (true) {

            $code == 0 => '☀️ Clear Sky',

            in_array($code,[1,2,3]) => '🌤 Partly Cloudy',

            in_array($code,[45,48]) => '🌫 Fog',

            $code >= 51 && $code <= 67 => '🌧 Rain',

            $code >= 71 && $code <= 86 => '❄ Snow',

            $code >= 95 => '⛈ Thunderstorm',

            default => '🌥 Cloudy'

        };
    }

}

@endphp
<div class="container-fluid">

    <!-- ====================== -->
    <!-- PAGE TITLE -->
    <!-- ====================== -->

    <div class="mb-4">

        <h2 class="fw-bold">

            🌦 Weather Dashboard

        </h2>

        <p class="text-muted">

            Real-time global weather monitoring for supply chain logistics.

        </p>

    </div>

    <!-- ====================== -->
    <!-- SELECT COUNTRY -->
    <!-- ====================== -->

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
                        {{ $selected == $country->name ? 'selected' : '' }}>

                        {{ $country->name }}

                    </option>

                @endforeach

            </select>

        </form>

    </div>

    <div class="col-md-3">

        <form action="{{ route('watchlist.store') }}" method="POST">

            @csrf

            <input
                type="hidden"
                name="country"
                value="{{ $selected }}">

            <button
                class="btn w-100"
                style="background:#8B5E3C;color:white;">

                👁 Add to Watchlist

            </button>

        </form>

    </div>

</div>
        <!-- ====================== -->
    <!-- WEATHER STATUS -->
    <!-- ====================== -->

    @php

        $status = match($weather['weather_code']) {

            0 => '☀ Clear Sky',

            1,2,3 => '⛅ Partly Cloudy',

            45,48 => '🌫 Fog',

            51,53,55 => '🌦 Drizzle',

            61,63,65 => '🌧 Rain',

            71,73,75 => '❄ Snow',

            80,81,82 => '🌦 Rain Shower',

            95 => '⛈ Thunderstorm',

            default => '🌤 Normal'

        };

        $risk = match(true) {

            $weather['wind_speed_10m'] >= 50 => 'HIGH',

            $weather['wind_speed_10m'] >= 25 => 'MEDIUM',

            default => 'LOW'

        };

    @endphp


    <div class="row">

        <!-- Weather Information -->

        <div class="col-lg-7">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white border-0">

                    <h5 class="fw-bold mb-0">

                        🌤 Current Weather

                    </h5>

                </div>

                <div class="card-body">

                    <h3 class="fw-bold">

                        {{ $country->name }}

                    </h3>

                    <hr>

                    <div class="row">

                        <div class="col-md-6 mb-3">

    <strong>Current Condition</strong>

    <br>

    <span class="fs-5">

        {{ $status }}

    </span>

    <br>

    <small class="text-muted">

        Weather Code :

        {{ $weather['weather_code'] }}

    </small>

</div>

                        <div class="col-md-6 mb-3">

                            <strong>Temperature</strong>

                            <br>

                            {{ $weather['temperature_2m'] }} °C
                        </div>

                        <div class="col-md-6 mb-3">

                            <strong>Humidity</strong>

                            <br>

                            {{ $weather['relative_humidity_2m'] }} %

                        </div>

                        <div class="col-md-6 mb-3">

    <strong>Wind Speed</strong>

    <br>

    {{ $weather['wind_speed_10m'] }} km/h

    <br>

    <small class="text-muted">

        @if($weather['wind_speed_10m'] < 15)

            💨 Light Wind

        @elseif($weather['wind_speed_10m'] < 30)

            🌬 Moderate Wind

        @else

            🌪 Strong Wind

        @endif

    </small>

</div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Weather Risk -->

        <div class="col-lg-5">

            <div class="card border-0 shadow-sm h-100">
            @php

$code = $weather['weather_code'];

if(in_array($code,[45,48])){

    $risk='MEDIUM';
    $badge='warning';
    $icon='🟡';
    $message='Fog may reduce transportation visibility.';

}
elseif($code>=51 && $code<=67){

    $risk='HIGH';
    $badge='danger';
    $icon='🟠';
    $message='Rain may delay shipping and logistics.';

}
elseif($code>=71){

    $risk='VERY HIGH';
    $badge='dark';
    $icon='🔴';
    $message='Extreme weather may disrupt transportation.';

}
else{

    $risk='LOW';
    $badge='success';
    $icon='🟢';
    $message='Weather conditions are good for shipping operations.';

}

@endphp
                <div class="card-header bg-white border-0">

                    <h5>

                    🚨 Weather Alert

                    </h5>

                </div>

                <div class="card-body">

                    @if($risk == 'LOW')

<div class="alert alert-success border-0 shadow-sm">

    <h3 class="fw-bold">
        {{ $icon }} {{ $risk }} RISK
    </h3>

    <p class="mb-0">
        {{ $message }}
    </p>

</div>

@elseif($risk == 'MEDIUM')

<div class="alert alert-warning border-0 shadow-sm">

    <h3 class="fw-bold">
        {{ $icon }} {{ $risk }} RISK
    </h3>

    <p class="mb-0">
        {{ $message }}
    </p>

</div>

@elseif($risk == 'HIGH')

<div class="alert alert-danger border-0 shadow-sm">

    <h3 class="fw-bold">
        {{ $icon }} {{ $risk }} RISK
    </h3>

    <p class="mb-0">
        {{ $message }}
    </p>

</div>

@else

<div class="alert alert-dark border-0 shadow-sm">

    <h3 class="fw-bold">
        {{ $icon }} {{ $risk }} RISK
    </h3>

    <p class="mb-0">
        {{ $message }}
    </p>

</div>

@endif
                </div>

            </div>

        </div>

    </div>


<!-- ====================== -->
<!-- 7 DAYS FORECAST -->
<!-- ====================== -->

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            📅 7 Days Forecast (Coming Soon)

        </h5>

    </div>

    <div class="card-body">

        <div class="row text-center">

@foreach($forecast['time'] as $index => $day)

<div class="col">

<div class="border rounded-3 p-3 h-100">

<h6>

{{ \Carbon\Carbon::parse($day)->format('D') }}

</h6>

<div class="display-6">

{{ weatherStatus($forecast['weather_code'][$index]) }}

</div>

<div class="mt-2">

    <div class="fw-bold text-dark">
        Maximum
    </div>

    <div class="fs-3 fw-bold">
        {{ round($forecast['temperature_2m_max'][$index]) }}°C
    </div>

    <div class="mt-3 fw-bold text-secondary">
        Minimum
    </div>

    <div class="fs-5">
        {{ round($forecast['temperature_2m_min'][$index]) }}°C
    </div>

</div>
</div>
</div>

@endforeach

</div>

    </div>

</div>

</div>

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

.form-select{

    height:48px;

    border-radius:12px;

}

.alert{

    border-radius:15px;

}

.display-6{

    font-size:42px;

}
.ts-wrapper{

    width:100%;

}

.ts-control{

    border-radius:14px !important;

    border:1px solid #ddd !important;

    min-height:52px !important;

    padding:12px 16px !important;

    font-size:15px;

    box-shadow:none !important;

    background:#fff !important;

}

.ts-control input{

    font-size:15px !important;

}

.ts-control.focus{

    border-color:#8B5E3C !important;

    box-shadow:0 0 0 .15rem rgba(139,94,60,.15)!important;

}

.ts-dropdown{

    border-radius:14px;

    overflow:hidden;

    border:none;

    box-shadow:0 10px 30px rgba(0,0,0,.12);

}

.ts-dropdown .option{

    padding:12px 16px;

}

.ts-dropdown .active{

    background:#8B5E3C;

    color:#fff;

}
</style>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

<script>
new TomSelect("#countrySelect", {

    create: false,
    maxItems: 1,

    searchField: ['text'],

    sortField: {
        field: 'text',
        direction: 'asc'
    },

    maxOptions: 254,

    onChange: function(value){

        if(value){
            this.input.closest("form").submit();
        }

    }

});
</script>

@endsection