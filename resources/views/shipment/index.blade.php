@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

    <!-- HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="top-title">
                🚢 Shipment Management
            </h2>

            <small class="text-muted">
                Monitor all import & export shipments
            </small>

        </div>

        <a href="/shipment/create" class="btn btn-brown">

            <i class="bi bi-plus-circle me-1"></i>

            Add Shipment

        </a>

    </div>

    <!-- SUMMARY CARD -->

    <div class="row mb-4">

        <!-- Total Shipment -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-box-seam summary-icon fs-1 mb-2"></i>

                    <h2 class="fw-bold">

                        {{ $shipments->count() }}

                    </h2>

                    <small class="text-muted">

                        Total Shipment

                    </small>

                </div>

            </div>

        </div>

        <!-- In Transit -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-truck summary-icon fs-1 mb-2"></i>

                    <h2 class="fw-bold">

                        {{ $shipments->where('status','In Transit')->count() }}

                    </h2>

                    <small class="text-muted">

                        In Transit

                    </small>

                </div>

            </div>

        </div>

        <!-- Destination -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-globe-asia-australia summary-icon fs-1 mb-2"></i>

                    <h2 class="fw-bold">

                        {{ $shipments->pluck('destination_country')->unique()->count() }}

                    </h2>

                    <small class="text-muted">

                        Destination Countries

                    </small>

                </div>

            </div>

        </div>

        <!-- Total Weight -->

        <div class="col-lg-3 col-md-6 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body text-center">

                    <i class="bi bi-speedometer2 summary-icon fs-1 mb-2"></i>

                    <h2 class="fw-bold">

                        {{ number_format($shipments->sum('weight'),2) }} Kg

                    </h2>

                    <small class="text-muted">

                        Total Weight

                    </small>

                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->

    <div class="card shadow-sm">

        <div class="card-header bg-white">

            <div class="row align-items-center">

                <div class="col-md-5">

                    <h5 class="mb-1">

                        📦 Shipment List

                    </h5>

                    <small class="text-muted">

                        {{ $shipments->count() }} Shipment Available

                    </small>

                </div>

                <div class="col-md-4">

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-search"></i>

                        </span>

                        <input
                            id="searchShipment"
                            type="text"
                            class="form-control"
                            placeholder="Search shipment...">

                    </div>

                </div>

                <div class="col-md-3">

                    <select
                        id="statusFilter"
                        class="form-select">

                        <option value="">All Status</option>

                        <option value="Preparing">Preparing</option>

                        <option value="In Transit">In Transit</option>

                        <option value="Delivered">Delivered</option>

                    </select>

                </div>

            </div>

        </div>

        <div class="card-body">

            <table class="table table-hover align-middle">

                <thead>

                    <tr>

                        <th>Tracking</th>

                        <th>Cargo</th>

                        <th>Origin</th>

                        <th>Destination</th>

                        <th>Status</th>

                        <th>Transport</th>

                        <th width="180">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($shipments as $shipment)

<tr class="shipment-row">

    <td>

        <span class="tracking-code">

            {{ $shipment->shipment_code }}

        </span>

    </td>

    <td>

        {{ $shipment->cargo_name }}

    </td>

    <td>

        {{ $shipment->origin_country }}

    </td>

    <td>

        {{ $shipment->destination_country }}

    </td>

    <td class="shipment-status">

        @if($shipment->status == 'Preparing')

            <span class="badge bg-warning">

                Preparing

            </span>

        @elseif($shipment->status == 'In Transit')

            <span class="badge bg-success">

                In Transit

            </span>

        @elseif($shipment->status == 'Delivered')

            <span class="badge bg-primary">

                Delivered

            </span>

        @else

            <span class="badge bg-secondary">

                {{ $shipment->status }}

            </span>

        @endif

    </td>

    <td>

        @if($shipment->transport_type == 'Ship')

            🚢 Ship

        @elseif($shipment->transport_type == 'Air')

            ✈ Air Cargo

        @elseif($shipment->transport_type == 'Truck')

            🚚 Truck

        @elseif($shipment->transport_type == 'Rail')

            🚆 Rail

        @else

            {{ $shipment->transport_type }}

        @endif

    </td>

    <td>

    <a href="{{ url('/shipment/'.$shipment->id) }}"
        class="btn btn-outline-brown btn-sm">

        <i class="bi bi-eye"></i>
        Detail

    </a>

    <a href="{{ url('/shipment/'.$shipment->id.'/edit') }}"
        class="btn btn-warning btn-sm">

        <i class="bi bi-pencil"></i>
        Edit

    </a>

    <form action="{{ url('/shipment/'.$shipment->id) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button
            onclick="return confirm('Delete this shipment?')"
            class="btn btn-danger btn-sm">

            <i class="bi bi-trash"></i>

        </button>

    </form>

</td>

</tr>

@empty

<tr>

<td colspan="7" class="text-center py-5">

<i class="bi bi-box-seam fs-1 text-muted"></i>

<h5 class="mt-3">

No Shipment Found

</h5>

<p class="text-muted">

Click <strong>Add Shipment</strong> to create your first shipment.

</p>

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

</div>

<script>

const search=document.getElementById('searchShipment');

const filter=document.getElementById('statusFilter');

function filterShipment(){

const keyword=search.value.toLowerCase();

const status=filter.value;

document.querySelectorAll('.shipment-row').forEach(function(row){

const text=row.innerText.toLowerCase();

const rowStatus=row.querySelector('.shipment-status').innerText.trim();

const matchSearch=text.includes(keyword);

const matchStatus=status===''||rowStatus===status;

row.style.display=(matchSearch&&matchStatus)?'':'none';

});

}

search.addEventListener('keyup',filterShipment);

filter.addEventListener('change',filterShipment);

</script>

@endsection