@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">

        <h2 class="fw-bold">
            🛠 Admin Dashboard
        </h2>

        <p class="text-muted mb-0">
            Welcome back, Administrator.
        </p>

    </div>

    {{-- WELCOME --}}
    <div class="alert alert-success border-0 shadow-sm">

        👋 Welcome Admin,
        <strong>{{ Auth::user()->name }}</strong>

    </div>

    {{-- SUMMARY --}}
    <div class="row g-4 mb-4">

        <div class="col-lg-4">

            <div class="card admin-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        👤

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ $totalUsers }}

                    </h2>

                    <p class="text-muted mb-0">

                        Registered Users

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card admin-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        ⚓

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ $totalPorts }}

                    </h2>

                    <p class="text-muted mb-0">

                        Port Dataset

                    </p>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card admin-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        📰

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ $totalNews }}

                    </h2>

                    <p class="text-muted mb-0">

                        Latest News

                    </p>

                </div>

            </div>

        </div>

    </div>

    {{-- QUICK ACCESS --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                ⚡ Quick Access

            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-lg-4">

                    <div class="quick-card">

                        <div class="quick-icon">

                            👤

                        </div>

                        <h5 class="fw-bold">

                            User Management

                        </h5>

                        <p class="text-muted">

                            View and manage registered users.

                        </p>

                        <a
                        href="{{ route('admin.users') }}"
                        class="btn btn-brown">

                            Open Users

                        </a>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="quick-card">

                        <div class="quick-icon">

                            ⚓

                        </div>

                        <h5 class="fw-bold">

                            Port Dataset

                        </h5>

                        <p class="text-muted">

                            Browse global port database.

                        </p>

                        <a
                        href="{{ route('admin.ports') }}"
                        class="btn btn-brown">

                            Open Ports

                        </a>

                    </div>

                </div>

                <div class="col-lg-4">

                    <div class="quick-card">

                        <div class="quick-icon">

                            📰

                        </div>

                        <h5 class="fw-bold">

                            News Monitoring

                        </h5>

                        <p class="text-muted">

                            View latest logistics news.

                        </p>

                        <a
                        href="{{ route('admin.news') }}"
                        class="btn btn-brown">

                            Open News

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
        {{-- RECENT ACTIVITY & SYSTEM STATUS --}}

    <div class="row">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">

                        📈 Recent Activity

                    </h5>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between py-2 border-bottom">

                        <span>

                            👤 Registered Users

                        </span>

                        <strong>

                            {{ $totalUsers }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">

                        <span>

                            ⚓ Port Dataset

                        </span>

                        <strong>

                            {{ number_format($totalPorts) }}

                        </strong>

                    </div>

                    <div class="d-flex justify-content-between py-2">

                        <span>

                            📰 Latest News

                        </span>

                        <strong>

                            {{ $totalNews }}

                        </strong>

                    </div>

                </div>

            </div>

        </div>

<style>

.admin-card{

    border:none;

    border-radius:18px;

    transition:.3s;

    box-shadow:0 8px 20px rgba(0,0,0,.08);

}

.admin-card:hover{

    transform:translateY(-6px);

    box-shadow:0 15px 30px rgba(0,0,0,.15);

}

.summary-icon{

    width:70px;

    height:70px;

    margin:auto;

    border-radius:50%;

    background:#F6F0EA;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:34px;

}

.quick-card{

    background:#FAF7F4;

    border-radius:16px;

    padding:25px;

    text-align:center;

    transition:.3s;

    height:100%;

}

.quick-card:hover{

    transform:translateY(-5px);

    box-shadow:0 12px 25px rgba(0,0,0,.12);

}

.quick-icon{

    width:70px;

    height:70px;

    margin:auto;

    border-radius:50%;

    background:#F6F0EA;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:34px;

    margin-bottom:18px;

}

.btn-brown{

    background:#8B5E3C;

    color:white;

    border:none;

}

.btn-brown:hover{

    background:#6F4E37;

    color:white;

}

.card-header{

    background:white;

    font-weight:700;

}

</style>

@endsection