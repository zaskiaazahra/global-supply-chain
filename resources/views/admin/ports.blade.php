@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- ========================= --}}
    {{-- PAGE HEADER --}}
    {{-- ========================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                ⚓ Port Management

            </h2>

            <p class="text-muted mb-0">

                Manage and monitor global port datasets.

            </p>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- SUMMARY --}}
    {{-- ========================= --}}

    <div class="row g-4 mb-4">

        {{-- PORTS --}}

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        ⚓

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ number_format($totalPorts) }}

                    </h2>

                    <p class="text-muted mb-0">

                        Total Ports

                    </p>

                </div>

            </div>

        </div>

        {{-- COUNTRIES --}}

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        🌍

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ $totalCountries }}

                    </h2>

                    <p class="text-muted mb-0">

                        Countries

                    </p>

                </div>

            </div>

        </div>

        {{-- HARBOR --}}

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        🚢

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ $totalHarbors }}

                    </h2>

                    <p class="text-muted mb-0">

                        Harbor Categories

                    </p>

                </div>

            </div>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- SEARCH --}}
    {{-- ========================= --}}

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                🔎 Search & Filter

            </h5>

        </div>

        <div class="card-body">

            <form method="GET">

                <div class="row g-3">

                    <div class="col-lg-5">

                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Search port..."
                            value="{{ request('search') }}">

                    </div>

                    <div class="col-lg-3">

                        <select
                            name="country"
                            class="form-select">

                            <option value="">

                                🌍 All Countries

                            </option>

                            @foreach($countries as $country)

                                @php

                                    $countryData = $countryList[$country] ?? null;

                                @endphp

                                <option
                                    value="{{ $country }}"
                                    {{ request('country')==$country?'selected':'' }}>

                                    {{ $countryData->name ?? $country }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-2">

                        <select
                            name="harbor"
                            class="form-select">

                            <option value="">

                                🚢 All Harbor

                            </option>

                            @foreach($harbors as $harbor)

                                <option
                                    value="{{ $harbor }}"
                                    {{ request('harbor')==$harbor?'selected':'' }}>

                                    {{ $harbor }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-lg-2 d-grid">

                        <button class="btn btn-brown">

                            <i class="bi bi-search"></i>

                            Search

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    @php

        $harborTranslate=[

            'Coastal (Natural)' => 'Pelabuhan Pantai',

            'Coastal (Breakwater)' => 'Pelabuhan Pantai',

            'River (Natural)' => 'Pelabuhan Sungai',

            'River (Tide Gates)' => 'Pelabuhan Sungai',

            'Open Roadstead' => 'Pelabuhan Terbuka',

            'Canal or Lake' => 'Kanal / Danau'

        ];

        $sizeTranslate=[

            'Very Small'=>'Sangat Kecil',

            'Small'=>'Kecil',

            'Medium'=>'Sedang',

            'Large'=>'Besar',

            'Very Large'=>'Sangat Besar'

        ];

    @endphp

    {{-- ========================= --}}
    {{-- TABLE --}}
    {{-- ========================= --}}

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="fw-bold mb-0">

                🌐 Global Port Dataset

            </h5>

            <span class="text-muted">

                {{ $ports->total() }} Records

            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th width="60">#</th>

                        <th>Port</th>

                        <th>Country</th>

                        <th>Harbor</th>

                        <th>Size</th>

                        <th>Coordinate</th>

                    </tr>

                </thead>

                <tbody>

                @foreach($ports as $port)
                <tr>

    {{-- NO --}}
    <td>

        {{ $loop->iteration + ($ports->currentPage()-1) * $ports->perPage() }}

    </td>

    {{-- PORT --}}
    <td>

        <div class="fw-semibold">

            {{ $port->port_name }}

        </div>

    </td>

    {{-- COUNTRY --}}
    <td>

        @php

            $country = $countryList[$port->country_code] ?? null;

        @endphp

        @if($country)

            <div class="d-flex align-items-center">

                @if(!empty($country->flag_url))

                    <img
                        src="{{ $country->flag_url }}"
                        width="24"
                        class="me-2 rounded shadow-sm">

                @endif

                <span>

                    {{ $country->name }}

                </span>

            </div>

        @else

            {{ $port->country_code }}

        @endif

    </td>

    {{-- HARBOR --}}
    <td>

        <span class="text-dark">

            {{ $harborTranslate[$port->harbor_type] ?? 'Lainnya' }}

        </span>

    </td>

    {{-- SIZE --}}
    <td>

        <span class="text-secondary">

            {{ $sizeTranslate[$port->harbor_size] ?? $port->harbor_size }}

        </span>

    </td>

    {{-- COORDINATE --}}
    <td>

        <small class="text-muted">

            {{ number_format($port->latitude,2) }}

            ,

            {{ number_format($port->longitude,2) }}

        </small>

    </td>

</tr>

@endforeach

</tbody>

</table>

</div>

<div class="card-footer bg-white">

    <div class="d-flex justify-content-center">

        {{ $ports->links() }}

    </div>

</div>

</div>
<style>

body{
    background:#F8F5F2;
}

/* ===========================
   CARD
=========================== */

.card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 24px rgba(0,0,0,.08);
}

.card-header{
    background:#fff;
    border-bottom:1px solid #eee;
    font-weight:700;
}

/* ===========================
   SUMMARY
=========================== */

.summary-card{
    transition:.3s;
}

.summary-card:hover{
    transform:translateY(-5px);
    box-shadow:0 18px 35px rgba(0,0,0,.12);
}

.summary-icon{
    width:70px;
    height:70px;
    margin:auto;
    border-radius:50%;
    background:#F5EEE8;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:32px;
}

/* ===========================
   TABLE
=========================== */

.table{
    margin-bottom:0;
}

.table thead th{
    background:#F8F5F2;
    color:#6F4E37;
    font-weight:700;
    border:none;
}

.table tbody td{
    vertical-align:middle;
}

.table tbody tr{
    transition:.25s;
}

.table tbody tr:hover{
    background:#FCFAF8;
}

/* ===========================
   FORM
=========================== */

.form-control,
.form-select{
    border-radius:12px;
    border:1px solid #ddd;
}

.form-control:focus,
.form-select:focus{
    border-color:#8B5E3C;
    box-shadow:0 0 0 .15rem rgba(111,78,55,.15);
}

/* ===========================
   BUTTON
=========================== */

.btn-brown{
    background:#8B5E3C;
    color:white;
    border:none;
    border-radius:12px;
}

.btn-brown:hover{
    background:#6F4E37;
    color:white;
}

/* ===========================
   FLAG
=========================== */

img{
    object-fit:cover;
}

/* ===========================
   PAGINATION
=========================== */

.pagination{
    margin-bottom:0;
}

.page-link{
    color:#6F4E37;
}

.page-item.active .page-link{
    background:#8B5E3C;
    border-color:#8B5E3C;
}

.page-link:hover{
    background:#8B5E3C;
    color:white;
}

/* ===========================
   RESPONSIVE
=========================== */

@media(max-width:768px){

.summary-card{
    margin-bottom:15px;
}

.table{
    font-size:14px;
}

}

</style>

@endsection