<!DOCTYPE html>
<html lang="id">
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
    font-family: Arial, sans-serif;
}

body{
    display:flex;
    background:#f4f6f9;
}

/* SIDEBAR */
.sidebar{
    width:230px;
    min-height:100vh;
    background:#0b0a2a;
    color:white;
    position:fixed;
}

.sidebar h2{
    text-align:center;
    padding:20px 0;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.profile{
    text-align:center;
    padding:20px 0;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.profile img{
    width:70px;
    border-radius:50%;
    background:white;
    padding:5px;
}

.profile p{
    margin-top:8px;
    font-size:14px;
    font-weight:bold;
}

.sidebar a, .sidebar button{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 20px;
    color:white;
    text-decoration:none;
    background:none;
    border:none;
    width:100%;
    cursor:pointer;
    font-size:14px;
}

.sidebar a:hover, .sidebar button:hover{
    background:#1b1955;
}

.sidebar .active{
    background:#1b1955;
}

/* MAIN */
.content{
    margin-left:230px;
    padding:25px;
    width:100%;
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

/* STATS */
.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(220px,1fr));
    gap:20px;
}

.stat-card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
    text-decoration:none;
    color:black;
    transition:0.2s;
}

.stat-card:hover{
    transform:translateY(-3px);
}

.stat-card h3{
    font-size:22px;
}

.stat-card small{
    color:#777;
}

.icon{
    font-size:22px;
    padding:15px;
    border-radius:50%;
    color:white;
}

.bg-red{background:#e74c3c;}
.bg-yellow{background:#f1c40f;}
.bg-blue{background:#3498db;}

</style>
</head>

<body>

<div class="sidebar">

<h2>Perpustakaan</h2>

<div class="profile">
<img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
<p>Admin</p>
</div>

<a href="{{ route('home') }}" class="active"><i class="fa fa-home"></i> Dashboard</a>
<a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
<a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
<a href="{{ route('transaksi.index') }}"><i class="fa fa-file-lines"></i> Data Transaksi</a>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
</form>

</div>

<div class="content">

<div class="header">
<h2>Dashboard</h2>
<div><i class="fa fa-user-circle"></i> Admin</div>
</div>

<div class="stats">

<a href="{{ route('anggota.index') }}" class="stat-card">
<div>
<h3>{{ $totalAnggota }}</h3>
<small>Total Anggota</small>
</div>
<i class="fa fa-users icon bg-red"></i>
</a>

<a href="{{ route('buku.index') }}" class="stat-card">
<div>
<h3>{{ $totalBuku }}</h3>
<small>Total Buku</small>
</div>
<i class="fa fa-book icon bg-yellow"></i>
</a>

<a href="{{ route('transaksi.index') }}" class="stat-card">
<div>
<h3>{{ $totalTransaksi }}</h3>
<small>Total Transaksi</small>
</div>
<i class="fa fa-file-lines icon bg-blue"></i>
</a>

</div>

</div>

</body>
</html>