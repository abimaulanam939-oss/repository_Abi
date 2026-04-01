<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Anggota - Perpustakaan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

body {
background: #f1f4f9;
padding: 40px;
}

.topbar {
display: flex;
justify-content: space-between;
align-items: center;
margin-bottom: 30px;
}

.topbar h2 { font-weight: 600; color: #333; }

.admin {
background: white;
padding: 8px 15px;
border-radius: 30px;
box-shadow: 0 3px 10px rgba(0,0,0,0.05);
font-weight: 500;
}

.form-wrapper {
display: flex;
justify-content: center;
}

.card {
background: white;
padding: 35px;
border-radius: 15px;
box-shadow: 0 8px 25px rgba(0,0,0,0.05);
width: 100%;
max-width: 900px;
}

.card h3 { 
margin-bottom: 25px; 
font-weight: 600; 
color: #333; 
}

label { 
font-size: 14px; 
font-weight: 500; 
color: #444; 
}

input {
width: 100%;
padding: 12px;
margin-top: 6px;
margin-bottom: 15px;
border: 1px solid #ddd;
border-radius: 8px;
font-size: 14px;
}

input:focus {
border-color: #3498db;
outline: none;
box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
}

.error {
background: #f8d7da;
color: #721c24;
padding: 10px;
border-radius: 8px;
margin-bottom: 20px;
}

.button-group {
margin-top: 15px;
display: flex;
gap: 10px;
}

.btn-primary {
background: linear-gradient(135deg, #3498db, #2980b9);
color: white;
border: none;
padding: 12px 20px;
border-radius: 8px;
cursor: pointer;
}

.btn-secondary {
background: #6c757d;
color: white;
padding: 12px 20px;
border-radius: 8px;
text-decoration: none;
}
</style>
</head>

<body>

<div class="topbar">
<h2>Tambah Anggota</h2>
<div class="admin">
<i class="fa fa-user-circle"></i> Admin
</div>
</div>

<div class="form-wrapper">
<div class="card">
<h3>Form Tambah Anggota</h3>

@if ($errors->any())
<div class="error">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('anggota.store') }}" method="POST">
@csrf

<label>Nama</label>
<input type="text" name="nama" value="{{ old('nama') }}" required>

<label>Kelas</label>
<input type="text" name="kelas" value="{{ old('kelas') }}" required>

<label>Jurusan</label>
<input type="text" name="jurusan" value="{{ old('jurusan') }}" required>

<div class="button-group">
<button type="submit" class="btn-primary">
<i class="fa fa-save"></i> Simpan
</button>

<a href="{{ route('anggota.index') }}" class="btn-secondary">
<i class="fa fa-arrow-left"></i> Kembali
</a>
</div>

</form>

</div>
</div>

</body>
</html>