<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Buku - Perpustakaan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
background:#0b0a2a;
color:white;
min-height:100vh;
position:fixed;
left:0;
top:0;
}

.sidebar h2{
text-align:center;
padding:18px 0;
border-bottom:1px solid rgba(255,255,255,0.1);
font-size:18px;
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

.sidebar a,
.sidebar button{
display:flex;
align-items:center;
gap:10px;
padding:13px 20px;
color:white;
text-decoration:none;
background:none;
border:none;
width:100%;
cursor:pointer;
font-size:14px;
transition:0.2s;
}

.sidebar a:hover,
.sidebar button:hover{
background:#1b1955;
}

.sidebar .active{
background:#1b1955;
}

/* MAIN */
.main{
margin-left:230px;
width:100%;
min-height:100vh;
}

/* NAVBAR */
.navbar{
background:white;
padding:15px 25px;
border-bottom:1px solid #e5e7eb;
display:flex;
justify-content:space-between;
align-items:center;
font-weight:bold;
}

/* CONTENT */
.content{
padding:25px;
}

/* CARD */
.card{
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

/* BUTTON */
.btn{
padding:7px 13px;
border-radius:6px;
color:white;
font-size:13px;
border:none;
cursor:pointer;
text-decoration:none;
display:inline-flex;
align-items:center;
gap:5px;
}

.btn-primary{background:#3498db;}
.btn-warning{background:#f39c12;}
.btn-danger{background:#e74c3c;}

.btn-primary:hover{background:#2980b9;}
.btn-warning:hover{background:#d68910;}
.btn-danger:hover{background:#c0392b;}

/* TOP BAR */
.top-bar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.top-bar h2{
font-size:18px;
}

/* SEARCH */
.search-box{
display:flex;
gap:8px;
}

.search-box input{
padding:8px 10px;
border:1px solid #ddd;
border-radius:6px;
outline:none;
}

.search-box input:focus{
border-color:#3498db;
}

/* TABLE */
table{
width:100%;
border-collapse:collapse;
}

th{
background:#34495e;
color:white;
padding:12px;
font-size:13px;
text-align:left;
}

td{
padding:12px;
border-bottom:1px solid #eee;
font-size:13px;
}

tr:hover{
background:#f8fafc;
}

.text-center{
text-align:center;
}

.empty{
text-align:center;
padding:20px;
color:#777;
}

</style>
</head>

<body>

<div class="sidebar">
<h2>Perpustakaan</h2>

<div class="profile">
<img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
<p>Admin</p>
</div>

<a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
<a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
<a href="{{ route('buku.index') }}" class="active"><i class="fa fa-book"></i> Data Buku</a>
<a href="{{ route('transaksi.index') }}"><i class="fa fa-file-lines"></i> Data Transaksi</a>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
</form>

</div>

<div class="main">

<div class="navbar">
<span>📚 Data Buku</span>
<span><i class="fa fa-user-circle"></i> Admin</span>
</div>

<div class="content">
<div class="card">

<div class="top-bar">
<h2>Daftar Buku</h2>

<div style="display:flex; gap:10px; align-items:center;">

<form action="{{ route('buku.index') }}" method="GET" class="search-box">
<input type="text" name="search" placeholder="Cari buku..." value="{{ request('search') }}">
<button class="btn btn-primary"><i class="fa fa-search"></i></button>
</form>

<a href="{{ route('buku.create') }}" class="btn btn-primary">
<i class="fa fa-plus"></i> Tambah
</a>

</div>
</div>

<table>
<thead>
<tr>
<th>No</th>
<th>Judul</th>
<th>No Seri Buku</th>
<th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@forelse ($bukus as $i => $b)
<tr>
<td>{{ $i+1 }}</td>
<td>{{ $b->judul }}</td>
<td>{{ $b->no_seri }}</td>

<td class="text-center">
<a href="{{ route('buku.edit',$b->id) }}" class="btn btn-warning">
<i class="fa fa-pen"></i>
</a>

<form action="{{ route('buku.destroy',$b->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn btn-danger" onclick="return confirm('Yakin hapus?')">
<i class="fa fa-trash"></i>
</button>
</form>
</td>
</tr>

@empty
<tr>
<td colspan="4" class="empty">Belum ada data buku</td>
</tr>
@endforelse
</tbody>

</table>

</div>
</div>

</div>

</body>
</html>