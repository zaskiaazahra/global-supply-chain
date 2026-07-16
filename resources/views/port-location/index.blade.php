@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

<div class="card border-0 shadow-sm mb-4">

<div class="card-body">

<div class="row align-items-end">

    <div class="col-md-9">

        <form method="GET">

            <label class="fw-bold mb-2">

                🌍 Select Country

            </label>

            <select
                class="form-select"
                name="country"
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

<div class="card border-0 shadow-sm mb-4">

<div class="card-header bg-white">

<h5 class="fw-bold mb-0">

🗺 World Port Map

</h5>

</div>

<div class="card border-0 shadow-sm mb-4">

<div class="card-header bg-white">

<h5 class="fw-bold">

⭐ Recommended Port

</h5>

</div>

<div class="card-body">

@if($recommendedPort)

<h4>

{{ $recommendedPort->port_name }}

</h4>

<p>

🌍 {{ $recommendedPort->country_code }}

</p>

<p>

📍 {{ $recommendedPort->region }}

</p>

<p>

🚢 {{ $recommendedPort->harbor_type }}

</p>

<p>

📦 {{ $recommendedPort->harbor_size }}

</p>

<div class="alert alert-success mb-0">

Recommended because this port has the highest harbor capacity for the selected country.

</div>

@else

<div class="alert alert-warning">

No recommendation available.

</div>

@endif

</div>

</div>

<div class="card-body">

<div id="map" style="height:550px;border-radius:12px;"></div>

</div>

</div>

<div class="card border-0 shadow-sm">

<div class="card-header bg-white d-flex justify-content-between align-items-center">

    <h5 class="fw-bold mb-0">
        🚢 World Port List
    </h5>

    <input
        type="text"
        id="searchPort"
        class="form-control"
        placeholder="Search Port..."
        style="width:250px;">

</div>

<div class="card-body p-0">

<div class="table-responsive">

<table class="table table-hover mb-0">

<thead>

<tr>

<th>Port</th>

<th>Region</th>

<th>Harbor Type</th>

<th>Harbor Size</th>

<th>Latitude</th>

<th>Longitude</th>

</tr>

</thead>

<tbody id="portTable">

@forelse($ports as $port)

<tr
    class="port-row"
    data-lat="{{ $port->latitude }}"
    data-lng="{{ $port->longitude }}">

    <td>{{ $port->port_name }}</td>

    <td>{{ $port->region }}</td>

    <td>{{ $port->harbor_type }}</td>

    <td>{{ $port->harbor_size }}</td>

    <td>{{ $port->latitude }}</td>

    <td>{{ $port->longitude }}</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center py-5">

No Port Found

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

</div>

@endsection

@push('scripts')

<script>

const ports = @json($ports);

const map = L.map('map').setView([0,115],4);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution:'© OpenStreetMap'
}).addTo(map);

let bounds = [];

ports.forEach(function(port){

    if(port.latitude && port.longitude){

        L.marker([
            parseFloat(port.latitude),
            parseFloat(port.longitude)
        ])
        .addTo(map)
        .bindPopup(`
            <b>${port.port_name}</b><br>
            🌍 ${port.country_code}<br>
            📍 ${port.region}<br>
            🚢 ${port.harbor_type}<br>
            📦 ${port.harbor_size}
        `);

        bounds.push([
            parseFloat(port.latitude),
            parseFloat(port.longitude)
        ]);

    }

});

if(bounds.length > 0){

    map.fitBounds(bounds,{
        padding:[30,30],
        maxZoom:7
    });

}
document
.getElementById('searchPort')
.addEventListener('keyup', function(){

    let keyword = this.value.toLowerCase();

    let rows = document.querySelectorAll('#portTable tr');

    rows.forEach(function(row){

        let text = row.innerText.toLowerCase();

        if(text.includes(keyword)){

            row.style.display = '';

        }else{

            row.style.display = 'none';

        }

    });

});
document.querySelectorAll('.port-row').forEach(function(row){

    row.style.cursor='pointer';

    row.addEventListener('click',function(){

        let lat=parseFloat(this.dataset.lat);

        let lng=parseFloat(this.dataset.lng);

        map.flyTo([lat,lng],10);

    });

});

</script>

@endpush