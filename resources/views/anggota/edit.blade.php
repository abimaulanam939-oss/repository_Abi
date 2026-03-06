<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Anggota - Perpustakaan</title>
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
        <a href="/home">Dashboard</a>
        <a href="/anggota">Data Anggota</a>
        <a href="/buku">Data Buku</a>
        <a href="/transaksi">Transaksi</a>
        <a href="/admin">Data Admin</a>
    </div>
</div>

<div class="content">
    <div class="card">

        <h2>Edit Data Anggota</h2>

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Nama</label>
            <input type="text"
                   name="nama"
                   value="{{ $anggota->nama }}"
                   required>

            <label>Kelas</label>
            <input type="text"
                   name="kelas"
                   value="{{ $anggota->kelas }}"
                   required>

            <label>Jurusan</label>
            <input type="text"
                   name="jurusan"
                   value="{{ $anggota->jurusan }}"
                   required>

            <button class="btn btn-save">Update</button>

            <a href="/anggota">
                <button type="button" class="btn btn-back">
                    Kembali
                </button>
            </a>

        </form>

    </div>
</div>

</body>
</html>