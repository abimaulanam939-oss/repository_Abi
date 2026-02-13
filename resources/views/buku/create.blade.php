<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font & Icon -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; background: #f1f4f9; }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0b0c2a, #1c1f4a);
            color: white;
            min-height: 100vh;
            padding: 25px 20px;
        }

        .sidebar h2 { text-align: center; margin-bottom: 25px; font-weight: 600; }

        .profile { text-align: center; margin-bottom: 30px; }

        .profile img {
            width: 85px;
            border-radius: 50%;
            border: 3px solid white;
            margin-bottom: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin-bottom: 8px;
            border-radius: 8px;
            transition: 0.3s;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,0.15);
        }

        .content {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
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

        .form-wrapper { display: flex; justify-content: center; }

        .card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 900px;
        }

        .card h3 { margin-bottom: 25px; font-weight: 600; color: #333; }

        label { font-size: 14px; font-weight: 500; color: #444; }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 5px;
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

        .success {
            background: #d4edda;
            color: #155724;
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

<div class="sidebar">
    <h2>Perpustakaan</h2>

    <div class="profile">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
        <p>Admin</p>
    </div>

    <div class="menu">
        <a href="#"><i class="fa fa-home"></i> Dashboard</a>
        <a href="{{ route('anggota.index') }}">
            <i class="fa fa-users"></i> Data Anggota
        </a>
        <a href="{{ route('buku.index') }}" class="active">
            <i class="fa fa-book"></i> Data Buku
        </a>
    </div>
</div>

<div class="content">

    <div class="topbar">
        <h2>Tambah Buku</h2>
        <div class="admin">
            <i class="fa fa-user-circle"></i> Admin
        </div>
    </div>

    <div class="form-wrapper">
        <div class="card">
            <h3>Form Tambah Buku</h3>

            {{-- Error --}}
            @if ($errors->any())
                <div class="error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success --}}
            @if(session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('buku.store') }}" method="POST">
                @csrf

                <label>Judul Buku</label>
                <input type="text" name="judul" value="{{ old('judul') }}" required>

                <label>Penulis</label>
                <input type="text" name="penulis" value="{{ old('penulis') }}" required>

                <label>Penerbit</label>
                <input type="text" name="penerbit" value="{{ old('penerbit') }}" required>

                <label>Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun') }}" required>

                <label>Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}" required>

                <div class="button-group">
                    <button type="submit" class="btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>

                    <a href="{{ route('buku.index') }}" class="btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>

        </div>
    </div>

</div>

</body>
</html>
