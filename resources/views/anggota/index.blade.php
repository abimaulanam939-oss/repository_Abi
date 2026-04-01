<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Anggota - Perpustakaan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    margin:0;
    font-family: Arial, sans-serif;
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
.main{
    margin-left:230px;
    width:100%;
}

.navbar{
    background:white;
    padding:15px 25px;
    border-bottom:1px solid #ddd;
    display:flex;
    justify-content:space-between;
    font-weight:bold;
}

.content{
    padding:25px;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

/* BUTTON */
.btn{
    padding:6px 12px;
    border-radius:6px;
    color:white;
    font-size:13px;
    border:none;
    cursor:pointer;
    text-decoration:none;
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
    margin-bottom:15px;
}

.search-box{
    display:flex;
    gap:8px;
}

.search-box input{
    padding:7px;
    border:1px solid #ccc;
    border-radius:5px;
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
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:13px;
}

tr:hover{
    background:#f9fafb;
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
<a href="{{ route('anggota.index') }}" class="active"><i class="fa fa-users"></i> Data Anggota</a>
<a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
<a href="{{ route('transaksi.index') }}"><i class="fa fa-file-lines"></i> Data Transaksi</a>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
</form>

</div>

<div class="main">

<div class="navbar">
<span>👥 Data Anggota</span>
<span><i class="fa fa-user-circle"></i> Admin</span>
</div>

<div class="content">
<div class="card">

<div class="top-bar">
<h2>Daftar Anggota</h2>

<div style="display:flex; gap:10px; align-items:center;">

<form action="{{ route('anggota.index') }}" method="GET" class="search-box">
<input type="text" name="search" placeholder="Cari anggota..." value="{{ request('search') }}">
<button class="btn btn-primary"><i class="fa fa-search"></i></button>
</form>

<a href="{{ route('anggota.create') }}" class="btn btn-primary">
<i class="fa fa-plus"></i> Tambah
</a>

</div>
</div>

<table>
<thead>
<tr>
<th>No</th>
<th>Nama</th>
<th>Kelas</th>
<th>Jurusan</th>
<th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@forelse ($anggotas as $i => $a)
<tr>
<td>{{ $i+1 }}</td>
<td>{{ $a->nama }}</td>
<td>{{ $a->kelas }}</td>
<td>{{ $a->jurusan }}</td>

<td class="text-center">
<a href="{{ route('anggota.edit',$a->id) }}" class="btn btn-warning">
<i class="fa fa-pen"></i>
</a>

<form action="{{ route('anggota.destroy',$a->id) }}" method="POST" style="display:inline;">
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
<td colspan="5" class="empty">Belum ada data anggota</td>
</tr>
@endforelse
</tbody>

</table>

</div>
</div>

</div>

</body>
</html>