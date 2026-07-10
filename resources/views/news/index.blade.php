@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

    {{-- Select Country --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <form method="GET">

                <label class="fw-bold mb-2">
                    🌍 Select Country
                </label>

                <select
                    class="form-select"
                    name="country"
                    onchange="this.form.submit()">

                    @foreach($countries as $item)

                        <option
                            value="{{ $item->name }}"
                            {{ $selected == $item->name ? 'selected' : '' }}>

                            {{ $item->name }}

                        </option>

                    @endforeach

                </select>

            </form>

        </div>
    </div>

    {{-- Header --}}
    <div class="mb-4">

        <h2 class="fw-bold">
            📰 Global News
        </h2>

        <p class="text-muted mb-0">
            Economy • Logistics • Geopolitics
        </p>

    </div>

    {{-- News --}}
    <div class="row g-4">

        @forelse($articles as $article)

            <div class="col-lg-4 col-md-6">

                <div class="card card-news h-100 border-0 shadow-sm">

                    @if(!empty($article['image']))
                        <img
                            src="{{ $article['image'] }}"
                            class="card-img-top"
                            style="height:220px;object-fit:cover;">
                    @endif

                    <div class="card-body d-flex flex-column">

                        <span
                            class="badge mb-3 align-self-start"
                            style="background:#8B5E3C;color:white;">

                            {{ $article['source']['name'] }}

                        </span>

                        <h5 class="fw-bold news-title">

                            {{ Str::limit($article['title'],70) }}

                        </h5>

                        <p class="text-muted news-desc flex-grow-1">

                            {{ Str::limit($article['description'],120) }}

                        </p>

                    </div>

                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">

                        <small class="text-muted">

                            {{ date('d M Y', strtotime($article['publishedAt'])) }}

                        </small>

                        <a
                            href="{{ $article['url'] }}"
                            target="_blank"
                            class="btn btn-sm btn-read">

                            Read More →

                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    No news available.

                </div>

            </div>

        @endforelse

    </div>

</div>

<style>

.card-news{
    border-radius:15px;
    overflow:hidden;
    transition:.3s;
}

.card-news:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.card-news img{
    height:220px;
    object-fit:cover;
    width:100%;
}

.news-title{
    font-size:1.25rem;
    line-height:1.5;
    min-height:90px;
}

.news-desc{
    line-height:1.6;
    min-height:85px;
}

.btn-read{
    background:#8B5E3C;
    color:white;
    border-radius:8px;
    padding:6px 14px;
}

.btn-read:hover{
    background:#6f472c;
    color:white;
}

</style>

@endsection