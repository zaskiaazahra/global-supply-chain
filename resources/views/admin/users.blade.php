@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">
                👤 User Management
            </h2>

            <p class="text-muted mb-0">
                Manage all registered users.
            </p>

        </div>

        <div class="d-flex gap-2">

            <span class="badge bg-primary fs-6 px-3 py-2">
                Total Users : {{ $users->total() }}
            </span>

            <a href="{{ route('register') }}"
               class="btn btn-success">

                <i class="bi bi-plus-circle me-1"></i>

                Add User

            </a>

        </div>

    </div>

    {{-- Card --}}
    <div class="card border-0 shadow-sm rounded-4">

        {{-- Search --}}
        <div class="card-header bg-white border-0 pt-4 px-4">

            <div class="row">

                <div class="col-lg-5">

                    <div class="input-group">

                        <span class="input-group-text bg-white">

                            <i class="bi bi-search"></i>

                        </span>

                        <input
                            id="searchUser"
                            type="text"
                            class="form-control border-start-0"
                            placeholder="Search name or email...">

                    </div>

                </div>

            </div>

        </div>

        {{-- Table --}}
        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    class="table table-hover align-middle mb-0"
                    id="userTable">

                    <thead>

                        <tr>

                            <th width="70">#</th>

                            <th>User</th>

                            <th>Email</th>

                            <th width="120">Role</th>

                            <th width="180" class="text-center">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($users as $user)

                        <tr>

                            <td>

                                {{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}

                            </td>

                            <td>

                                <div class="d-flex align-items-center">

                                    <div class="avatar">

                                        {{ strtoupper(substr($user->name,0,1)) }}

                                    </div>

                                    <div class="ms-3">

                                        <div class="fw-semibold">

                                            {{ $user->name }}

                                        </div>

                                        <small class="text-muted">

                                            ID :
                                            {{ $user->id }}

                                        </small>

                                    </div>

                                </div>

                            </td>

                            <td>

                                {{ $user->email }}

                            </td>
                                                        </td>

                            {{-- ROLE --}}
                            <td>

                                @if(strtolower($user->role) == 'admin')

                                    <span class="badge rounded-pill bg-success px-3 py-2">

                                        <i class="bi bi-shield-check me-1"></i>

                                        Admin

                                    </span>

                                @else

                                    <span class="badge rounded-pill text-bg-secondary px-3 py-2">

                                        <i class="bi bi-person me-1"></i>

                                        User

                                    </span>

                                @endif

                            </td>

                            {{-- ACTION --}}
                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <a
                                        href="{{ route('admin.users.edit',$user) }}"
                                        class="btn btn-warning btn-sm rounded-pill px-3">

                                        <i class="bi bi-pencil-square"></i>

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('admin.users.destroy',$user) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm rounded-pill px-3">

                                            <i class="bi bi-trash"></i>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Pagination --}}
        <div class="card-footer bg-white border-0 py-3">

            {{ $users->links() }}

        </div>

    </div>
    </div>

<style>

body{
    background:#F8F5F2;
}

/* Card */
.card{
    border-radius:18px;
}

/* Table */
.table thead{
    background:#F6F0EA;
}

.table thead th{
    border:none;
    color:#6B4B32;
    font-weight:700;
    padding:16px;
}

.table tbody td{
    padding:18px 16px;
    vertical-align:middle;
}

.table tbody tr{
    transition:.25s;
}

.table tbody tr:hover{
    background:#FCF8F4;
}

/* Avatar */
.avatar{

    width:48px;
    height:48px;

    border-radius:50%;

    background:#8B5E3C;

    color:#fff;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:18px;
    font-weight:700;

    box-shadow:0 4px 12px rgba(139,94,60,.25);

}

/* Search */
.input-group-text{
    border-radius:12px 0 0 12px;
}

.form-control{
    border-radius:0 12px 12px 0;
}

.form-control:focus{

    border-color:#8B5E3C;

    box-shadow:0 0 0 .15rem rgba(139,94,60,.15);

}

/* Badge */
.badge{
    font-size:13px;
}

/* Buttons */
.btn{
    border-radius:10px;
}

.btn-warning{

    color:#fff;

}

.btn-warning:hover{

    color:#fff;

}

.card-header{
    border-bottom:1px solid #F0F0F0;
}

.card-footer{
    border-top:1px solid #F0F0F0;
}

</style>

<script>

const searchInput=document.getElementById("searchUser");

searchInput.addEventListener("keyup",function(){

let value=this.value.toLowerCase();

document.querySelectorAll("#userTable tbody tr").forEach(function(row){

row.style.display=row.innerText.toLowerCase().includes(value)
? ""
: "none";

});

});

</script>

@endsection