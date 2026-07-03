@extends('layouts.app')

@section('content')

<div class="container-fluid">

    @include('layouts.navbar')

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body">

                    <h6 class="text-muted">🌍 Countries</h6>

                    <h2>{{ $totalCountries }}</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body">

                    <h6 class="text-muted">🚢 Active Shipment</h6>

                    <h2>0</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body">

                    <h6 class="text-muted">⚠ High Risk</h6>

                    <h2>0</h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card">

                <div class="card-body">

                    <h6 class="text-muted">💰 USD / IDR</h6>

                    <h2>Loading...</h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-8 mb-4">

            <div class="card">

                <div class="card-header">

                    🚢 Shipment Tracking

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Shipment Tracking akan ditampilkan di sini.

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mb-4">

            <div class="card">

                <div class="card-header">

                    🌍 Country Overview

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Pilih negara untuk melihat kondisi ekonomi, cuaca, kurs, dan risiko.

                    </p>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-6">

            <div class="card">

                <div class="card-header">

                    📰 Latest Global News

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Berita global akan muncul di sini.

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-6">

            <div class="card">

                <div class="card-header">

                    ⚠ Risk Analysis

                </div>

                <div class="card-body">

                    <p class="text-muted">

                        Risk Score akan dihitung berdasarkan cuaca, kurs, inflasi dan berita.

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection