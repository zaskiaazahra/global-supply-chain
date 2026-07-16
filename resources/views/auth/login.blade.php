<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | Global Supply Chain</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{

background:linear-gradient(135deg,#5D4037,#8B5E3C);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

font-family:'Segoe UI',sans-serif;

}

.login-card{

width:430px;

border:none;

border-radius:22px;

overflow:hidden;

box-shadow:0 15px 45px rgba(0,0,0,.25);

}

.card-body{

padding:45px;

}

.logo{

font-size:55px;

}

.form-control{

height:52px;

border-radius:12px;

}

.btn-login{

background:#8B5E3C;

color:white;

height:52px;

border-radius:12px;

font-weight:600;

}

.btn-login:hover{

background:#6F4E37;

color:white;

}

a{

text-decoration:none;

}

</style>

</head>

<body>

<div class="card login-card">

<div class="card-body">

<div class="text-center mb-4">

<div class="logo">

🌍

</div>

<h2 class="fw-bold">

Global Supply Chain

</h2>

<p class="text-muted">

Risk Intelligence Platform

</p>

</div>

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

{{ $errors->first() }}

</div>

@endif

<form method="POST"
action="{{ url('/login') }}">

@csrf

<div class="mb-3">

<label class="fw-semibold">

Email

</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-4">

<label class="fw-semibold">

Password

</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
class="btn btn-login w-100">

<i class="bi bi-box-arrow-in-right"></i>

Login

</button>

</form>

<div class="text-center mt-4">

Don't have an account?

<a href="{{ url('/register') }}">

Register

</a>

</div>

</div>

</div>

</body>

</html>