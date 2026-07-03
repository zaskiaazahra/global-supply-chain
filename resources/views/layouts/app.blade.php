<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Global Supply Chain</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

body{
    background:#F8F5F2;
    font-family:'Segoe UI',sans-serif;
    margin:0;
}

.sidebar{
    width:260px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    background:#5C4033;
    color:white;
    padding:25px;
    box-shadow:3px 0 15px rgba(0,0,0,.1);
}

.sidebar h3{
    font-weight:700;
    margin-bottom:40px;
    text-align:center;
    line-height:1.4;
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:13px 15px;
    border-radius:10px;
    margin-bottom:10px;
    transition:.3s;
    font-weight:500;
}

.sidebar a:hover{
    background:#A67C52;
    padding-left:20px;
}

.active-menu{
    background:#A67C52;
}

.content{
    margin-left:280px;
    padding:35px;
}

.card{
    border:none;
    border-radius:18px;
    transition:.3s;
    box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.card:hover{
    transform:translateY(-5px);
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.card-header{
    background:#FFFFFF;
    border-bottom:1px solid #E9E5E1;
    color:#5C4033;
    font-weight:600;
    border-radius:18px 18px 0 0 !important;
    padding:15px 20px;
}

.card-body{
    padding:25px;
}

.top-title{
    color:#5C4033;
    font-weight:700;
}

.text-muted{
    color:#7A7A7A !important;
}

</style>

</head>

<body>
    @include('layouts.sidebar')

<div class="content">

    @yield('content')

</div>

</body>
</html>