<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

body{
    font-family:Arial;
    background:#f4f6f9;
    margin:0;
}

.header{
    background:#2c3e50;
    color:white;
    padding:15px;
}

.container{
    width:600px;
    margin:auto;
    margin-top:40px;
}

.card{
    background:white;
    padding:25px;
    border-radius:8px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
}

label{
    font-weight:bold;
}

input,select{
    width:100%;
    padding:8px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}

select[multiple]{
    height:150px;
}

.info{
    font-size:12px;
    color:#666;
    margin-top:-10px;
    margin-bottom:15px;
}

.btn{
    padding:10px 15px;
    border:none;
    border-radius:5px;
    cursor:pointer;
}

.btn-simpan{
    background:#27ae60;
    color:white;
}

.btn-kembali{
    background:#e74c3c;
    color:white;
    text-decoration:none;
    padding:10px 15px;
}

</style>

</head>
<body>

<div class="header">
<h2>📚 Tambah Transaksi Peminjaman</h2>
</div>

<div class="container">

<div class="card">

<form action="{{ route('transaksi.store') }}" method="POST">

@csrf

<label>Anggota</label>
<select name="anggota_id" required>

<option value="">-- pilih anggota --</option>

@foreach($anggotas as $a)
<option value="{{ $a->id }}">
{{ $a->nama }}
</option>
@endforeach

</select>


<label>Pilih Buku</label>
<select name="buku_id[]" multiple required>

@foreach($bukus as $b)
<option value="{{ $b->id }}">
{{ $b->judul }} (stok : {{ $b->stok }})
</option>
@endforeach

</select>

<div class="info">
Gunakan <b>CTRL + Klik</b> untuk memilih lebih dari satu buku
</div>


<label>Tanggal Pinjam</label>
<input type="date" name="tanggal_pinjam" required>


<label>Tanggal Kembali</label>
<input type="date" name="tanggal_kembali" required>


<!-- kondisi default -->
<input type="hidden" name="kondisi" value="baik">


<button type="submit" class="btn btn-simpan">
<i class="fa fa-save"></i> Simpan
</button>

<a href="{{ route('transaksi.index') }}" class="btn-kembali">
<i class="fa fa-arrow-left"></i> Kembali
</a>

</form>

</div>

</div>

</body>
</html>