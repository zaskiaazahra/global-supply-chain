@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

<div class="d-flex justify-content-between mb-4">

<div>

<h2>

🚢 Shipment Detail

</h2>

<small class="text-muted">

Tracking Information

</small>

</div>

<a href="/shipment" class="btn btn-secondary">

Back

</a>

</div>

<div class="row">

<div class="col-lg-4">

<div class="card">

<div class="card-header">

Shipment Information

</div>

<div class="card-body">

<p>

<strong>Tracking :</strong>

{{ $shipment->shipment_code }}

</p>

<p>

<strong>Cargo :</strong>

{{ $shipment->cargo_name }}

</p>

<p>

<strong>Origin :</strong>

{{ $shipment->origin_country }}

</p>

<p>

<strong>Destination :</strong>

{{ $shipment->destination_country }}

</p>

<p>

<strong>Status :</strong>

<span class="badge bg-success">

{{ $shipment->status }}

</span>

</p>

<p>

<strong>Transport :</strong>

{{ $shipment->transport_type }}

</p>

<p>

<strong>Weight :</strong>

{{ $shipment->weight }} Kg

</p>

</div>

</div>

</div>

<div class="col-lg-8">

<div class="card">

<div class="card-header">

🗺 Live Shipment Location

</div>

<div class="card-body">

<div id="shipmentMap"

style="height:450px;border-radius:12px;">

</div>

</div>

</div>

</div>

</div>

</div>

<script>

var map = L.map('shipmentMap').setView([

{{ $shipment->latitude }},

{{ $shipment->longitude }}

],5);

L.tileLayer(

'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',

{

attribution:'© OpenStreetMap'

}

).addTo(map);

L.marker([

{{ $shipment->latitude }},

{{ $shipment->longitude }}

]).addTo(map)

.bindPopup(

'{{ $shipment->cargo_name }}'

)

.openPopup();

</script>

@endsection