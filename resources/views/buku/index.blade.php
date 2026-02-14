<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            background: #0d0b2e;
            color: white;
            height: 100vh;
            padding-top: 20px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .profile {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            padding: 5px;
        }

        .profile p {
            margin-top: 10px;
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            font-size: 15px;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background: #1a174f;
        }

        .sidebar .active {
            background: #1a174f;
        }

        .main {
            flex: 1;
        }

        .navbar {
            background: white;
            padding: 15px 25px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content {
            padding: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .btn {
            padding: 7px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-primary { background: #3498db; }
        .btn-warning { background: #f39c12; }
        .btn-danger { background: #e74c3c; }

        .btn-primary:hover { background: #2980b9; }
        .btn-warning:hover { background: #d68910; }
        .btn-danger:hover { background: #c0392b; }

        .search-input {
            padding: 6px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f1f1;
        }

        .text-center {
            text-align: center;
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

    <a href="{{ route('home') }}">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="{{ route('anggota.index') }}">
        <i class="fa fa-users"></i> Data Anggota
    </a>

    <a href="{{ route('buku.index') }}" class="active">
        <i class="fa fa-book"></i> Data Buku
    </a>

    <a href="#">
        <i class="fa fa-right-left"></i> Transaksi
    </a>

    <a href="#">
        <i class="fa fa-user"></i> Data Admin
    </a>
</div>

<div class="main">

    <div class="navbar">
        <h3>Data Buku</h3>
        <div>
            <i class="fa fa-user-circle"></i> Admin
        </div>
    </div>

    <div class="content">
        <div class="card">

            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
                <h2>Daftar Buku</h2>

                <div style="display:flex; gap:10px; align-items:center;">
                    
                    <!-- SEARCH -->
                    <form action="{{ route('buku.index') }}" method="GET" style="display:flex; gap:5px;">
                        <input type="text" 
                               name="search" 
                               class="search-input"
                               placeholder="Cari buku..."
                               value="{{ request('search') }}">
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <!-- TAMBAH -->
                    <a href="{{ route('buku.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Tambah Buku
                    </a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukus as $index => $b)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $b->judul }}</td>
                        <td>{{ $b->penulis }}</td>
                        <td>{{ $b->penerbit }}</td>
                        <td>{{ $b->tahun }}</td>
                        <td>{{ $b->stok }}</td>
                        <td class="text-center">
                            <a href="{{ route('buku.edit', $b->id) }}" class="btn btn-warning">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form action="{{ route('buku.destroy', $b->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Data buku belum tersedia</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

</body>
</html>
