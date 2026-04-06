<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Transaksi - Perpustakaan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family: Arial, Helvetica, sans-serif;
}

body{
display:flex;
background:#f4f6f9;
}

/* SIDEBAR */
.sidebar{
width:230px;
background:#0b0a2a;
min-height:100vh;
color:white;
position:fixed;
left:0;
top:0;
}

.sidebar h2{
text-align:center;
padding:18px 0;
font-size:18px;
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

.sidebar a,
.sidebar button{
display:flex;
align-items:center;
gap:10px;
padding:13px 20px;
color:white;
text-decoration:none;
font-size:14px;
background:none;
border:none;
width:100%;
cursor:pointer;
transition:0.2s;
}

.sidebar a:hover,
.sidebar button:hover{
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
font-weight:bold;
border-bottom:1px solid #e5e7eb;
display:flex;
justify-content:space-between;
align-items:center;
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
padding:6px 12px;
border:none;
border-radius:6px;
font-size:12px;
cursor:pointer;
text-decoration:none;
display:inline-flex;
align-items:center;
gap:5px;
color:white;
}

.btn-add{background:#27ae60;}
.btn-kembali{background:#3498db;}
.btn-edit{background:#8e44ad;}
.btn-save{background:#e67e22;}
.btn-delete{background:#e74c3c;}

.btn-add:hover{background:#219150;}
.btn-kembali:hover{background:#2980b9;}
.btn-edit:hover{background:#6c3483;}
.btn-save:hover{background:#ca6f1e;}
.btn-delete:hover{background:#c0392b;}

/* SEARCH */
.top-bar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:15px;
}

.search-box{
display:flex;
gap:10px;
}

.search-box input{
padding:8px 10px;
width:250px;
border:1px solid #ddd;
border-radius:6px;
outline:none;
}

.search-box button{
padding:8px 12px;
background:#3498db;
color:white;
border:none;
border-radius:6px;
cursor:pointer;
}

/* TABLE */
table{
width:100%;
border-collapse:collapse;
margin-top:15px;
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
font-size:13px;
border-bottom:1px solid #eee;
vertical-align:top;
}

tr:hover{
background:#f8fafc;
}

/* STATUS */
.status{
padding:5px 10px;
border-radius:5px;
font-size:12px;
color:white;
}

.dikembalikan{background:#27ae60;}

/* DENDA */
.denda{
color:#e74c3c;
font-weight:bold;
}

/* SELECT */
.select-kondisi{
padding:4px;
border-radius:5px;
border:1px solid #ccc;
font-size:12px;
margin-left:5px;
}

/* TEXT */
.telat{
color:red;
font-size:12px;
font-weight:bold;
}

.batas{
font-size:12px;
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
<a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
<a href="{{ route('transaksi.index') }}"><i class="fa fa-file-lines"></i> Data Transaksi</a>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button type="submit">
<i class="fa fa-sign-out-alt"></i> Logout
</button>
</form>

</div>

<div class="main">

<div class="navbar">
<span>📄 Data Transaksi</span>
<span><i class="fa fa-user-circle"></i> Admin</span>
</div>

<div class="content">
<div class="card">

<div class="top-bar">
<h2>Data Transaksi</h2>

<a href="{{ route('transaksi.create') }}" class="btn btn-add">
<i class="fa fa-plus"></i> Tambah
</a>
</div>

<form method="GET" action="{{ route('transaksi.index') }}" class="search-box">
<input type="text" name="search" placeholder="Cari anggota / buku..." value="{{ request('search') }}">
<button type="submit"><i class="fa fa-search"></i></button>
</form>

<table>

<tr>
<th>No</th>
<th>Anggota</th>
<th>Kelas</th>
<th>Jurusan</th>
<th>Buku</th>
<th>Tgl Pinjam</th>
<th>Tgl Kembali</th>
<th>Denda</th>
<th>Status</th>
<th>Aksi</th>
</tr>

@foreach($transaksis as $i => $t)

<tr>

<td>{{ $i+1 }}</td>
<td>{{ $t->anggota->nama }}</td>
<td>{{ $t->anggota->kelas }}</td>
<td>{{ $t->anggota->jurusan }}</td>

<td>
@foreach($t->detail as $d)

<div style="margin-bottom:6px;">
<form action="{{ route('detail.update',$d->id) }}" method="POST" style="display:inline;">
@csrf
@method('PUT')

{{ $d->buku->judul ?? '-' }}

<select name="kondisi" class="select-kondisi">
<option value="dipinjam" {{ $d->kondisi=='dipinjam'?'selected':'' }}>Dipinjam</option>
<option value="dikembalikan" {{ $d->kondisi=='dikembalikan'?'selected':'' }}>Kembali</option>
<option value="rusak" {{ $d->kondisi=='rusak'?'selected':'' }}>Rusak</option>
<option value="hilang" {{ $d->kondisi=='hilang'?'selected':'' }}>Hilang</option>
</select>

<button class="btn btn-save">
<i class="fa fa-save"></i>
</button>

</form>
</div>

@endforeach
</td>

<td>{{ $t->tanggal_pinjam }}</td>

<td>
<strong>{{ $t->tanggal_kembali }}</strong><br>

@if(now()->gt($t->tanggal_kembali) && $t->status=='dipinjam')
<span class="telat">
Telat {{ \Carbon\Carbon::parse($t->tanggal_kembali)->diffInDays(now()) }} hari
</span>
@else
<span class="batas">Batas Pengembalian</span>
@endif

</td>

<td class="denda">Rp {{ number_format($t->denda) }}</td>

<td>
@if($t->status=='dipinjam')
<a href="{{ route('transaksi.kembalikan',$t->id) }}" class="btn btn-kembali">
<i class="fa fa-undo"></i>
</a>
@else
<span class="status dikembalikan">Selesai</span>
@endif
</td>

<td>

<a href="{{ route('transaksi.edit',$t->id) }}" class="btn btn-edit">
<i class="fa fa-pen"></i>
</a>

<form action="{{ route('transaksi.destroy',$t->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn btn-delete" onclick="return confirm('Yakin?')">
<i class="fa fa-trash"></i>
</button>
</form>

</td>

</tr>

@endforeach

</table>

</div>
</div>

</div>

<script>
document.querySelectorAll('.select-kondisi').forEach(function(select){
select.addEventListener('change', function(){

let row = this.closest('tr');
let dendaCell = row.querySelector('.denda');
let total = 0;

row.querySelectorAll('.select-kondisi').forEach(function(s){
if(s.value === "rusak") total += 10000;
if(s.value === "hilang") total += 50000;
});

dendaCell.innerHTML = "Rp " + total.toLocaleString('id-ID');

});
});
</script>

</body>
</html>