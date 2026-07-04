@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">

            <h4 class="mb-1">

             🚢 Add New Shipment

            </h4>

            <small class="text-muted">

             Create a new import/export shipment record

            </small>

        </div>

        <div class="card-body">

            <form action="/shipment" method="POST">

                @csrf

                <div class="row">

                    <!-- Cargo -->
                    <div class="col-md-6 mb-3">

                        <label>Cargo Name</label>

                        <input type="text"
                               class="form-control"
                               name="cargo_name"
                               required>

                    </div>

                    <!-- Weight -->
                    <div class="col-md-6 mb-3">

                        <label>Weight (Kg)</label>

                        <input type="number"
                               class="form-control"
                               name="weight"
                               required>

                    </div>

                    <!-- Origin -->
                    <div class="col-md-6 mb-3">

                        <label>Origin Country</label>

                        <select class="form-select"
                                name="origin_country"
                                required>

                            <option value="">
                                -- Select Origin Country --
                            </option>

                            @foreach($countries as $country)

                                <option value="{{ $country->name }}">

                                    {{ $country->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Destination -->
                    <div class="col-md-6 mb-3">

                        <label>Destination Country</label>

                        <select id="destination_country"
                                class="form-select"
                                name="destination_country"
                                required>

                            <option value="">
                                -- Select Destination Country --
                            </option>

                            @foreach($countries as $country)

                                <option
                                    value="{{ $country->name }}"
                                    data-lat="{{ $country->latitude }}"
                                    data-lng="{{ $country->longitude }}">

                                    {{ $country->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Transport -->
                    <div class="col-md-6 mb-3">

                        <label>Transport</label>

                        <select class="form-select" name="transport_type">

                        <option>🚢 Ship</option>

                        <option>✈ Air Cargo</option>

                        <option>🚚 Truck</option>

                        <option>🚆 Rail</option>

                        </select>

                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-3">

                        <label>Status</label>

                        <select class="form-select"
                                name="status">

                            <option>Preparing</option>

                            <option>Loading</option>

                            <option>In Transit</option>

                            <option>Delivered</option>

                        </select>

                    </div>

                    <!-- Departure -->
                    <div class="col-md-6 mb-3">

                        <label>Departure Date</label>

                        <input type="date"
                               class="form-control"
                               name="departure_date">

                    </div>

                    <!-- ETA -->
                    <div class="col-md-6 mb-3">

                        <label>Estimated Arrival</label>

                        <input type="date"
                               class="form-control"
                               name="estimated_arrival">

                    </div>

                    <!-- Latitude -->
                    <div class="col-md-6 mb-3">

    <label>
        📍 Latitude
    </label>

    <input
        type="text"
        id="latitude"
        name="latitude"
        class="form-control bg-light"
        readonly>

    <small class="text-success">

<i class="bi bi-check-circle-fill"></i>

Coordinates loaded from

<b id="countryName"></b>

</small>

</div>

                    <!-- Longitude -->
                    <div class="col-md-6 mb-3">

    <label>
        🧭 Longitude
    </label>

    <input
        type="text"
        id="longitude"
        name="longitude"
        class="form-control bg-light"
        readonly>

    <small class="text-muted">

<i class="bi bi-info-circle"></i>

Auto-generated from selected destination.

</small>

</div>
                </div>

                <button class="btn btn-brown">

                  <i class="bi bi-floppy"></i>

                   Save Shipment

</button>
            </form>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const destination = document.getElementById("destination_country");

    destination.addEventListener("change", function () {

        const option = this.options[this.selectedIndex];

        document.getElementById("latitude").value =
            option.dataset.lat || "";

        document.getElementById("longitude").value =
            option.dataset.lng || "";

        document.getElementById("countryName").innerHTML =
            option.value || "";

    });

});

</script>
@endsection