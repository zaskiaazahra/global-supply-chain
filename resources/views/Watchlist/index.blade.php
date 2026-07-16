@extends('layouts.app')

@section('content')

@include('layouts.navbar')

<div class="container-fluid">

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">
    👁️ Country Watchlist
</h5>

    </div>

    <div class="card-body">

        <form action="{{ route('watchlist.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-10">

                    <select
                        name="country"
                        class="form-select"
                        required>

                        <option value="">
                            Choose a Country to Monitor
                        </option>

                        @foreach($countries as $country)

                        <option value="{{ $country->name }}">
                            {{ $country->name }}
                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-2">

                    <button
                        class="btn w-100"
                        style="background:#6F4E37;color:white;border:none;">

                        <i class="bi bi-plus-circle"></i>

                        Add to Watchlist

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="fw-bold mb-0">
            🌍 Countries Under Monitoring
        </h5>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="70">#</th>

                    <th>Monitored Country</th>

                    <th width="120">Action</th>

                </tr>

            </thead>

            <tbody>

                @forelse($watchlists as $watchlist)

                <tr>

                    <td>
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        <strong>{{ $watchlist->country }}</strong>
                    </td>

                    <td>

                        <form
                            action="{{route('watchlist.destroy',$watchlist->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-sm"
                                style="background:#8B5E3C;color:white;border:none;">

                                <i class="bi bi-trash"></i>

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="text-center py-5">

                        <i class="bi bi-star fs-2 d-block mb-2"></i>

                        Your watchlist is empty.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection