@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- ========================= --}}
    {{-- HEADER --}}
    {{-- ========================= --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                📰 News Intelligence
            </h2>

            <p class="text-muted mb-0">

    Monitoring logistics, trade, shipping and economy news from

    <strong>{{ $country }}</strong>.

</p>
        </div>

    </div>

    {{-- ========================= --}}
    {{-- SUMMARY --}}
    {{-- ========================= --}}

    @php

        $sources = collect($news)
            ->pluck('source.name')
            ->filter()
            ->unique()
            ->count();

    @endphp

    <div class="row g-4 mb-4">

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        📰

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ count($news) }}

                    </h2>

                    <p class="text-muted mb-0">

                        Total Articles

                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        🌍

                    </div>

                    <h2 class="fw-bold mt-3">

                        {{ $sources }}

                    </h2>

                    <p class="text-muted mb-0">

                        Media Sources

                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card summary-card">

                <div class="card-body text-center">

                    <div class="summary-icon">

                        🕒

                    </div>

                    <h5 class="fw-bold mt-3">

    {{ now()->format('d M Y') }}

</h5>

<p class="text-muted mb-0">

    Last Updated

</p>
                </div>

            </div>

        </div>

    </div>

    {{-- ========================= --}}
    {{-- SEARCH --}}
    {{-- ========================= --}}

    <div class="card shadow-sm mb-4">

    <div class="card-body">

        <form method="GET">

            <div class="row g-3">

                <div class="col-md-4">

                    <select
                        name="country"
                        class="form-select"
                        onchange="this.form.submit()">

                        @foreach($countries as $item)

                            <option
                                value="{{ $item }}"
                                {{ $country == $item ? 'selected' : '' }}>

                                {{ $item }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-8">

                    <div class="input-group">

                        <span class="input-group-text bg-white">

                            <i class="bi bi-search"></i>

                        </span>

                        <input
                            type="text"
                            id="searchNews"
                            class="form-control border-start-0"
                            placeholder="Search article title...">

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

    {{-- ========================= --}}
    {{-- NEWS LIST --}}
    {{-- ========================= --}}

    <div class="row g-4" id="newsContainer">

        @foreach($news as $article)
        <div class="col-lg-6 news-card">

    <div class="card h-100 shadow-sm border-0">

        {{-- IMAGE --}}
        @if(!empty($article['image']))

            <img
                src="{{ $article['image'] }}"
                class="card-img-top"
                style="height:220px;object-fit:cover;">

        @else

            <div
                class="d-flex align-items-center justify-content-center"
                style="height:220px;background:#F5F1ED;">

                <div class="text-center text-muted">

                    <i class="bi bi-image fs-1"></i>

                    <br>

                    No Image Available

                </div>

            </div>

        @endif

        <div class="card-body d-flex flex-column">

            {{-- SOURCE --}}
            <div class="mb-2">

                <span class="badge bg-light text-dark border">

                    🌍 {{ $article['source']['name'] ?? 'Unknown Source' }}

                </span>

            </div>

            {{-- TITLE --}}
            <h5 class="fw-bold mb-3">

                {{ $article['title'] }}

            </h5>

            {{-- DESCRIPTION --}}
            <p class="text-muted flex-grow-1">

                {{ \Illuminate\Support\Str::limit($article['description'] ?? 'No description available.',150) }}

            </p>

            {{-- DATE --}}
            <small class="text-secondary mb-3">

                <i class="bi bi-calendar-event"></i>

                {{ \Carbon\Carbon::parse($article['publishedAt'])->format('d M Y • H:i') }}

            </small>

            {{-- BUTTON --}}
            <div>

                <a
                    href="{{ $article['url'] }}"
                    target="_blank"
                    class="btn btn-brown w-100">

                    <i class="bi bi-box-arrow-up-right me-2"></i>

                    Read Full Article

                </a>

            </div>

        </div>

    </div>

</div>

@endforeach

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
    transition:.3s;
}

.news-card .card:hover{

    transform:translateY(-6px);

    box-shadow:0 18px 35px rgba(0,0,0,.12);

}

/* ===========================
   SUMMARY
=========================== */

.summary-card{

    border:none;

    border-radius:18px;

}

.summary-icon{

    width:70px;

    height:70px;

    margin:auto;

    border-radius:50%;

    background:#F5EEE8;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:32px;

}

/* ===========================
   SEARCH
=========================== */

.form-control{

    border-radius:0 12px 12px 0;

}

.input-group-text{

    border-radius:12px 0 0 12px;

}

.form-control:focus{

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

    transition:.25s;

}

.btn-brown:hover{

    background:#6F4E37;

    color:white;

}

/* ===========================
   IMAGE
=========================== */

.card-img-top{

    transition:.35s;

}

.news-card:hover .card-img-top{

    transform:scale(1.03);

}

/* ===========================
   BADGE
=========================== */

.badge{

    font-size:12px;

    padding:7px 12px;

}

/* ===========================
   RESPONSIVE
=========================== */

@media(max-width:768px){

.card-img-top{

height:190px !important;

}

.summary-card{

margin-bottom:15px;

}

}

</style>

<script>

document.getElementById("searchNews")
.addEventListener("keyup",function(){

let value=this.value.toLowerCase();

let cards=document.querySelectorAll(".news-card");

cards.forEach(function(card){

card.style.display=

card.innerText.toLowerCase().includes(value)

? ""

: "none";

});

});

</script>

@endsection