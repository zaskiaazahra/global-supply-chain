@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="top-title">
✏ Edit Shipment
</h2>

<small class="text-muted">
Update shipment information
</small>

</div>

<a href="/shipment" class="btn btn-outline-secondary">

<i class="bi bi-arrow-left"></i>

Back

</a>

</div>

<div class="card shadow-sm">

<div class="card-header">

<h4 class="mb-0">
🚢 Edit Shipment
</h4>

</div>

<div class="card-body">

<form action="{{ url('/shipment/'.$shipment->id) }}" method="POST">

@csrf
@method('PUT')

<div class="row">

<div class="col-md-6 mb-3">

<label>Cargo Name</label>

<input
type="text"
class="form-control"
name="cargo_name"
value="{{ $shipment->cargo_name }}"
required>

</div>

<div class="col-md-6 mb-3">

<label>Weight (Kg)</label>

<input
type="number"
step="0.01"
class="form-control"
name="weight"
value="{{ $shipment->weight }}">

</div>

<div class="col-md-6 mb-3">

<label>Origin Country</label>

<select
class="form-select"
name="origin_country">

@foreach($countries as $country)

<option
value="{{ $country->name }}"
{{ $shipment->origin_country==$country->name ? 'selected' : '' }}>

{{ $country->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Destination Country</label>

<select
id="destination_country"
class="form-select"
name="destination_country">

@foreach($countries as $country)

<option
value="{{ $country->name }}"
data-lat="{{ $country->latitude }}"
data-lng="{{ $country->longitude }}"
{{ $shipment->destination_country==$country->name ? 'selected' : '' }}>

{{ $country->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Transport</label>

<select
class="form-select"
name="transport_type">

<option {{ $shipment->transport_type=='Ship' ? 'selected' : '' }}>
Ship
</option>

<option {{ $shipment->transport_type=='Air' ? 'selected' : '' }}>
Air
</option>

<option {{ $shipment->transport_type=='Truck' ? 'selected' : '' }}>
Truck
</option>

<option {{ $shipment->transport_type=='Rail' ? 'selected' : '' }}>
Rail
</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select
class="form-select"
name="status">

<option {{ $shipment->status=='Preparing' ? 'selected' : '' }}>
Preparing
</option>

<option {{ $shipment->status=='In Transit' ? 'selected' : '' }}>
In Transit
</option>

<option {{ $shipment->status=='Delivered' ? 'selected' : '' }}>
Delivered
</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Departure Date</label>

<input
type="date"
class="form-control"
name="departure_date"
value="{{ $shipment->departure_date }}">

</div>

<div class="col-md-6 mb-3">

<label>Estimated Arrival</label>

<input
type="date"
class="form-control"
name="estimated_arrival"
value="{{ $shipment->estimated_arrival }}">

</div>

<div class="col-md-6 mb-3">

<label>Latitude</label>

<input
id="latitude"
type="text"
class="form-control"
name="latitude"
value="{{ $shipment->latitude }}"
readonly>

<small class="text-muted">
Coordinates loaded automatically
</small>

</div>

<div class="col-md-6 mb-3">

<label>Longitude</label>

<input
id="longitude"
type="text"
class="form-control"
name="longitude"
value="{{ $shipment->longitude }}"
readonly>

<small class="text-muted">
Coordinates loaded automatically
</small>

</div>

</div>

<button class="btn btn-brown">

<i class="bi bi-check-circle"></i>

Update Shipment

</button>

</form>

</div>

</div>

</div>

<script>

const destination=document.getElementById('destination_country');

const lat=document.getElementById('latitude');

const lng=document.getElementById('longitude');

destination.addEventListener('change',function(){

let option=this.options[this.selectedIndex];

lat.value=option.dataset.lat;

lng.value=option.dataset.lng;

});

</script>

@endsection