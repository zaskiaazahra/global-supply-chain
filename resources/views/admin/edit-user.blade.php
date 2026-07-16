@extends('layouts.admin')

@section('content')

<div class="container">

    <h2 class="mb-4">
        ✏️ Edit User
    </h2>

    <div class="card">

        <div class="card-body">

            <form
                action="{{ route('admin.users.update',$user) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label>Nama</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name',$user->name) }}">

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email',$user->email) }}">

                </div>

                <div class="mb-3">

                    <label>Role</label>

                    <select
                        name="role"
                        class="form-select">

                        <option
                            value="Admin"
                            {{ $user->role=='Admin'?'selected':'' }}>
                            Admin
                        </option>

                        <option
                            value="User"
                            {{ $user->role=='User'?'selected':'' }}>
                            User
                        </option>

                    </select>

                </div>

                <button class="btn btn-success">

                    💾 Simpan

                </button>

                <a
                    href="{{ route('admin.users') }}"
                    class="btn btn-secondary">

                    Batal

                </a>

            </form>

        </div>

    </div>

</div>

@endsection