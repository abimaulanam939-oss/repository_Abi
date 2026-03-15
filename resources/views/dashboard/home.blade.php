<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Perpustakaan</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    display:flex;
    background:linear-gradient(135deg,#eef2f7,#e3e9f2);
}

.sidebar{
    width:260px;
    min-height:100vh;
    background:linear-gradient(180deg,#141e30,#243b55);
    color:white;
    padding:25px 20px;
    position:fixed;
}

.sidebar h3{
    text-align:center;
    margin-bottom:20px;
}

.sidebar .profile{
    text-align:center;
    margin-bottom:30px;
}

.sidebar .profile img{
    width:80px;
    border-radius:50%;
    border:3px solid white;
    margin-bottom:10px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px;
    margin-bottom:8px;
    text-decoration:none;
    color:white;
    border-radius:8px;
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.15);
}

.content{
    margin-left:260px;
    padding:40px;
    width:100%;
}

.header{
    display:flex;
    justify-content:space-between;
    margin-bottom:30px;
}

.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));
    gap:20px;
    margin-bottom:30px;
}

.stat-card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 25px rgba(0,0,0,0.05);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.stat-card i{
    font-size:30px;
    padding:18px;
    border-radius:50%;
    color:white;
}

.bg-red{background:#e74c3c;}
.bg-yellow{background:#f1c40f;}
.bg-blue{background:#3498db;}

.panel{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.05);
}

.flex{
    display:flex;
    gap:20px;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th, .table td{
    border:1px solid #ddd;
    padding:8px;
}

.table th{
    background:#f4f4f4;
}
</style>
</head>

<body>

<div class="sidebar">

    <h3>Perpustakaan</h3>

    <div class="profile">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
        <p>Admin</p>
    </div>

    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
    <a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
    <a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
    <a href="{{ route('transaksi.index') }}"><i class="fa fa-exchange-alt"></i> Data Transaksi</a>
   <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </button>
</form>
</form>
</div>


<div class="content">

<div class="header">
<h2>Dashboard</h2>
<div><i class="fa fa-user-circle"></i> Admin</div>
</div>


<div class="stats">

<a href="{{ route('anggota.index') }}">
<div class="stat-card">
<div>
<h3>{{ $totalAnggota }}</h3>
<small>Total Anggota</small>
</div>
<i class="fa fa-users bg-red"></i>
</div>
</a>


<a href="{{ route('buku.index') }}">
<div class="stat-card">
<div>
<h3>{{ $totalBuku }}</h3>
<small>Total Buku</small>
</div>
<i class="fa fa-book bg-yellow"></i>
</div>
</a>






</body>
</html>