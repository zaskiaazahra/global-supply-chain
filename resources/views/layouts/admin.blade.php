<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Global Supply Chain | Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

body{

    margin:0;

    background:#F8F5F2;

    font-family:'Segoe UI',sans-serif;

}

.wrapper{

    display:flex;

    min-height:100vh;

}

/* ================= SIDEBAR ================= */

.sidebar{

    width:260px;

    background:#6F4E37;

    color:white;

    position:fixed;

    left:0;

    top:0;

    bottom:0;

    display:flex;

    flex-direction:column;

    box-shadow:4px 0 20px rgba(0,0,0,.08);

}

.sidebar-header{

    padding:28px 20px;

    text-align:center;

    border-bottom:1px solid rgba(255,255,255,.15);

}

.sidebar-header h3{

    font-weight:700;

    margin:0;

}

.sidebar-header small{

    color:#ddd;

}

.sidebar-menu{

    padding:20px 15px;

    flex:1;

}

.sidebar-menu a{

    display:flex;

    align-items:center;

    gap:12px;

    color:white;

    text-decoration:none;

    padding:12px 16px;

    border-radius:12px;

    margin-bottom:8px;

    transition:.3s;

}

.sidebar-menu a:hover{

    background:rgba(255,255,255,.15);

}

.sidebar-menu a.active{

    background:white;

    color:#6F4E37;

    font-weight:700;

}

.sidebar-footer{

    padding:20px;

    border-top:1px solid rgba(255,255,255,.15);

}

.admin-box{

    text-align:center;

    margin-bottom:20px;

}

.admin-avatar{

    width:70px;

    height:70px;

    border-radius:50%;

    background:white;

    color:#6F4E37;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:34px;

    margin:auto;

}

.logout-btn{

    width:100%;

    background:#DC3545;

    color:white;

    border:none;

    border-radius:10px;

    padding:10px;

    transition:.3s;

}

.logout-btn:hover{

    background:#BB2D3B;

}

/* ================= CONTENT ================= */

.main-content{

    margin-left:260px;

    flex:1;

    padding:35px;

}

.card{

    border:none;

    border-radius:18px;

    box-shadow:0 10px 25px rgba(0,0,0,.05);

}

.card-header{

    background:white;

    font-weight:700;

}

.btn-brown{

    background:#8B5E3C;

    color:white;

}

.btn-brown:hover{

    background:#6F4E37;

    color:white;

}

.summary-card{

    transition:.3s;

}

.summary-card:hover{

    transform:translateY(-5px);

    box-shadow:0 15px 30px rgba(0,0,0,.12);

}

.summary-icon{

    width:70px;

    height:70px;

    border-radius:50%;

    background:#F6F0EA;

    display:flex;

    justify-content:center;

    align-items:center;

    margin:auto;

    font-size:34px;

}

.table thead{

    background:#F8F5F2;

}

.table th{

    color:#6F4E37;

}

.badge{

    border-radius:20px;

    padding:8px 12px;

}

</style>

</head>

<body>

<div class="wrapper">

<div class="sidebar">

<div class="sidebar-header">

<h3>🌍 Admin Panel</h3>

<small>Global Supply Chain</small>

</div>

<div class="sidebar-menu">

<a href="{{ route('admin.dashboard') }}"
class="{{ request()->routeIs('admin.dashboard')?'active':'' }}">
<i class="bi bi-speedometer2"></i>
Dashboard
</a>

<a href="{{ route('admin.users') }}"
class="{{ request()->routeIs('admin.users')?'active':'' }}">
<i class="bi bi-people-fill"></i>
Users
</a>

<a href="{{ route('admin.ports') }}"
class="{{ request()->routeIs('admin.ports')?'active':'' }}">
<i class="bi bi-anchor-fill"></i>
Ports
</a>

<a href="{{ route('admin.news') }}"
class="{{ request()->routeIs('admin.news')?'active':'' }}">
<i class="bi bi-newspaper"></i>
News
</a>

</div>

<div class="sidebar-footer">

<div class="admin-box">

<div class="admin-avatar">

<i class="bi bi-person-fill"></i>

</div>

<h5 class="mt-3 mb-1">

Admin

</h5>

<small>

System Administrator

</small>

</div>

<form method="POST"
action="{{ route('logout') }}">

@csrf

<button class="logout-btn">

<i class="bi bi-box-arrow-right"></i>

Logout

</button>

</form>

</div>

</div>

<div class="main-content">

@yield('content')

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>