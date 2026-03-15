<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Transaksi - Perpustakaan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
font-family: Arial, Helvetica, sans-serif;
background:#f4f6f9;
margin:0;
display:flex;
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
padding:20px 0;
font-size:20px;
font-weight:bold;
border-bottom:1px solid rgba(255,255,255,0.1);
}

.profile{
text-align:center;
padding:20px 0;
border-bottom:1px solid rgba(255,255,255,0.1);
}

.profile img{
width:70px;
height:70px;
border-radius:50%;
background:white;
padding:5px;
}

.profile p{
margin-top:8px;
font-weight:bold;
font-size:14px;
}

.sidebar a{
display:flex;
align-items:center;
gap:10px;
padding:12px 20px;
color:white;
text-decoration:none;
font-size:14px;
transition:0.3s;
}

.sidebar a:hover{
background:#1b1955;
}

.sidebar i{
width:18px;
text-align:center;
}

/* CONTENT */

.main{
margin-left:230px;
width:100%;
}

.header{
background:#ffffff;
padding:15px 25px;
font-size:20px;
font-weight:bold;
border-bottom:1px solid #ddd;
}

.container{
width:95%;
margin:30px auto;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

h2{
margin-bottom:20px;
color:#333;
}

.btn{
padding:6px 12px;
border:none;
border-radius:5px;
font-size:12px;
cursor:pointer;
text-decoration:none;
margin:2px;
}

.btn-add{background:#27ae60;color:white;}
.btn-kembali{background:#3498db;color:white;}
.btn-edit{background:#8e44ad;color:white;}
.btn-save{background:#e67e22;color:white;}
.btn-delete{background:#e74c3c;color:white;}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:10px;
border-bottom:1px solid #ddd;
text-align:left;
font-size:14px;
}

th{
background:#34495e;
color:white;
}

.status{
padding:5px 10px;
border-radius:5px;
font-size:12px;
color:white;
}

.dipinjam{background:#3498db;}
.dikembalikan{background:#27ae60;}

.denda{
color:#e74c3c;
font-weight:bold;
}

.select-kondisi{
padding:4px;
font-size:12px;
margin-left:5px;
}

.telat{
color:red;
font-size:12px;
font-weight:bold;
}

.batas{
font-size:12px;
color:#666;
}

/* SEARCH */

.search-box{
margin-top:15px;
margin-bottom:15px;
}

.search-box input{
padding:7px 10px;
width:250px;
border:1px solid #ccc;
border-radius:5px;
font-size:13px;
}

.search-box button{
padding:7px 12px;
border:none;
background:#3498db;
color:white;
border-radius:5px;
cursor:pointer;
font-size:13px;
}

</style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

<h2>Perpustakaan</h2>

<div class="profile">
<img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
<p>Admin</p>
</div>

<a href="{{ route('home') }}">
<i class="fa fa-home"></i> Dashboard
</a>

<a href="{{ route('anggota.index') }}">
<i class="fa fa-users"></i> Data Anggota
</a>

<a href="{{ route('buku.index') }}">
<i class="fa fa-book"></i> Data Buku
</a>

<a href="{{ route('transaksi.index') }}">
<i class="fa fa-file-lines"></i> Data Transaksi
</a>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" style="background:none;border:none;color:rgb(135, 126, 143);cursor:pointer;">
        <i class="fa fa-sign-out-alt"></i> Logout
    </button>
</form>

</div>

<!-- MAIN CONTENT -->
<div class="main">

<div class="header">
<i class="fa-solid fa-book"></i> Sistem Perpustakaan
</div>

<div class="container">

<h2><i class="fa-solid fa-file-lines"></i> Data Transaksi</h2>

<a href="{{ route('transaksi.create') }}" class="btn btn-add">
<i class="fa fa-plus"></i> Tambah Transaksi
</a>

<!-- SEARCH -->
<form method="GET" action="{{ route('transaksi.index') }}" class="search-box">

<input type="text" name="search" placeholder="Cari anggota / buku..." value="{{ request('search') }}">

<button type="submit">
<i class="fa fa-search"></i> Cari
</button>

</form>

<table>

<tr>
<th>No</th>
<th>Anggota</th>
<th>Buku</th>
<th>Tanggal Pinjam</th>
<th>Tanggal Kembali</th>
<th>Denda</th>
<th>Status</th>
<th>Aksi</th>
</tr>

@foreach($transaksis->filter(function($t){
$search = request('search');
if(!$search) return true;

return str_contains(strtolower($t->anggota->nama), strtolower($search)) ||
$t->detail->contains(function($d) use ($search){
return str_contains(strtolower($d->buku->judul), strtolower($search));
});
}) as $i => $t)

<tr>

<td>{{ $i+1 }}</td>

<td>{{ $t->anggota->nama }}</td>

<td>

@foreach($t->detail as $d)

<form action="{{ route('detail.update',$d->id) }}" method="POST">

@csrf
@method('PUT')

• {{ $d->buku->judul }}

<select name="kondisi" class="select-kondisi">

<option value="dipinjam" {{ $d->kondisi == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
<option value="dikembalikan" {{ $d->kondisi == 'dikembalikan' ? 'selected' : '' }}>Kembali</option>
<option value="rusak" {{ $d->kondisi == 'rusak' ? 'selected' : '' }}>Rusak</option>
<option value="hilang" {{ $d->kondisi == 'hilang' ? 'selected' : '' }}>Hilang</option>

</select>

<button type="submit" class="btn btn-save">
<i class="fa fa-save"></i>
</button>

</form>

<br>

@endforeach

</td>

<td>{{ $t->tanggal_pinjam }}</td>

<td>

<strong>{{ $t->tanggal_kembali }}</strong>

<br>

@if(\Carbon\Carbon::now()->gt($t->tanggal_kembali) && $t->status == 'dipinjam')

<span class="telat">
Telat {{ \Carbon\Carbon::parse($t->tanggal_kembali)->diffInDays(now()) }} hari
</span>

@else

<span class="batas">
Batas Pengembalian
</span>

@endif

</td>

<td class="denda">
Rp {{ number_format($t->denda) }}
</td>

<td>

@if($t->status == 'dipinjam')

<a href="{{ route('transaksi.kembalikan',$t->id) }}" class="btn btn-kembali">
<i class="fa fa-undo"></i> Kembalikan
</a>

@else

<span class="status dikembalikan">Dikembalikan</span>

@endif

</td>

<td>

<a href="{{ route('transaksi.edit',$t->id) }}" class="btn btn-edit">
<i class="fa fa-pen"></i>
</a>

<form action="{{ route('transaksi.destroy',$t->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')

<button type="submit" class="btn btn-delete"
onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
<i class="fa fa-trash"></i>
</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

</div>

<script>

document.querySelectorAll('.select-kondisi').forEach(function(select){

select.addEventListener('change', function(){

let row = this.closest('tr');
let dendaCell = row.querySelector('.denda');

let totalDenda = 0;

row.querySelectorAll('.select-kondisi').forEach(function(s){

if(s.value === "rusak"){
totalDenda += 10000;
}

if(s.value === "hilang"){
totalDenda += 50000;
}

});

dendaCell.innerHTML = "Rp " + totalDenda.toLocaleString('id-ID');

});

});

</script>

</body>
</html>