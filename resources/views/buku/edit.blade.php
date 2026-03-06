<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Buku - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #eef1f5;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(#0d1b2a,#1b263b);
            color: white;
        }

        .sidebar h2 {
            text-align: center;
            padding: 15px;
        }

        .profile {
            text-align: center;
            padding: 10px;
        }

        .profile img {
            width: 80px;
            border-radius: 50%;
        }

        .menu {
            margin-top: 20px;
        }

        .menu a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
        }

        .menu a:hover {
            background: #415a77;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            width: 600px;
            margin: auto;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
        }

        label {
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-save {
            background: #2ecc71;
            color: white;
        }

        .btn-back {
            background: #95a5a6;
            color: white;
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

    <div class="menu">
        <a href="/home"><i class="fa fa-home"></i> Dashboard</a>
        <a href="/anggota"><i class="fa fa-users"></i> Data Anggota</a>
        <a href="/buku"><i class="fa fa-book"></i> Data Buku</a>
        <a href="/transaksi"><i class="fa fa-exchange-alt"></i> Transaksi</a>
        <a href="/admin"><i class="fa fa-user"></i> Data Admin</a>
    </div>
</div>

<div class="content">

    <h2>Edit Data Buku</h2>

    <div class="card">

        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Judul Buku</label>
            <input type="text" name="judul" value="{{ $buku->judul }}" required>

            <label>Penulis</label>
            <input type="text" name="penulis" value="{{ $buku->penulis }}" required>

            <label>Penerbit</label>
            <input type="text" name="penerbit" value="{{ $buku->penerbit }}" required>

            <label>Tahun</label>
            <input type="number" name="tahun" value="{{ $buku->tahun }}" required>

            <label>Stok</label>
            <input type="number" name="stok" value="{{ $buku->stok }}" required>

            <button type="submit" class="btn btn-save">
                Update
            </button>

            <a href="{{ route('buku.index') }}">
                <button type="button" class="btn btn-back">
                    Kembali
                </button>
            </a>

        </form>

    </div>

</div>

</body>
</html>