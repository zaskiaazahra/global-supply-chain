@extends('layouts.app')

@section('content')

    <title>Countries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            font-family: Arial;
            margin:40px;
        }

        table{
            border-collapse: collapse;
            width:100%;
        }

        table,th,td{
            border:1px solid #ddd;
        }

        th,td{
            padding:10px;
        }

        th{
            background:#0d6efd;
            color:white;
        }

        img{
            width:50px;
        }

    </style>

</head>

<body>

<h2>Daftar Negara</h2>

<form method="GET">

    <input
        type="text"
        name="search"
        placeholder="Cari negara..."
        value="{{ $search }}"
        style="padding:10px; width:300px;">

    <button type="submit">
        Cari
    </button>

</form>

<br>

<table>

<tr>
    <th>Flag</th>
    <th>Country</th>
    <th>Capital</th>
    <th>Region</th>
    <th>Currency</th>
</tr>

@foreach($data as $country)

<tr>

    <td>
        <img src="{{ $country->flag_url }}" width="50">
    </td>

    <td>
        {{ $country->name }}
    </td>

    <td>
        {{ $country->capital ?? '-' }}
    </td>

    <td>
        {{ $country->region }}
    </td>

    <td>
        {{ $country->currency_name ?? '-' }}
    </td>

</tr>

@endforeach

</table>
<br>

{{ $data->links() }}

@endsection