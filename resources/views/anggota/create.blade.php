<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Anggota - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #0b0c2a;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile img {
            width: 80px;
            border-radius: 50%;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .menu a:hover,
        .menu a.active {
            background: #1c1f4a;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
        }

        .card h3 {
            margin-bottom: 20px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .admin {
            font-weight: bold;
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

        <div class="menu">
            <a href="#">Dashboard</a>
            <a href="{{ route('anggota.index') }}" class="active">
                <i class="fa fa-users"></i> Data Anggota
            </a>
            <a href="#">Data Buku</a>
            <a href="#">Transaksi</a>
            <a href="#">Data Admin</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="topbar">
            <h2>Tambah Anggota</h2>
            <div class="admin">
                <i class="fa fa-user-circle"></i> Admin
            </div>
        </div>

        <div class="card">
            <h3>Form Tambah Anggota</h3>

            <form action="{{ route('anggota.store') }}" method="POST">
                @csrf

                <label>Nama</label>
                <input type="text" name="nama" required>

                <label>Email</label>
                <input type="email" name="email" required>

                <label>No HP</label>
                <input type="text" name="no_hp" required>

                <label>Alamat</label>
                <textarea name="alamat" required></textarea>

                <button type="submit">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>

    </div>

</body>
</html>