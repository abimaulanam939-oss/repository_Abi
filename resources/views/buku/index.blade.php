<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f4f6f9;
            --sidebar-dark: #0b1120;
            --primary-blue: #3498db;
            --success-green: #2ecc71;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        body { display: flex; background: var(--bg-body); color: #333; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: var(--sidebar-dark);
            color: white;
            min-height: 100vh;
            position: fixed;
        }

        .sidebar .brand {
            padding: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-section {
            text-align: center;
            padding: 30px 10px;
        }

        .profile-section img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.2);
            padding: 3px;
            background: #fff;
        }

        .profile-section p {
            margin-top: 10px;
            font-weight: 600;
            font-size: 14px;
        }

        .sidebar a, .sidebar button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: #a0aec0;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
            background: none; border: none; width: 100%; cursor: pointer;
        }

        .sidebar a:hover, .sidebar .active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid var(--primary-blue);
        }

        /* MAIN CONTENT */
        .main { margin-left: 240px; width: 100%; }

        .top-nav {
            background: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .content { padding: 30px; }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 { font-size: 22px; color: #2d3748; }

        /* SEARCH BAR CUSTOM */
        .search-container {
            display: flex;
            gap: 10px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .search-box-wrapper {
            display: flex;
            flex: 1;
            max-width: 400px;
        }

        .search-box-wrapper input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px 0 0 6px;
            outline: none;
        }

        .btn-filter {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0 15px;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
        }

        /* TABLE STYLING */
        .card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04);
        }

        table { width: 100%; border-collapse: collapse; }

        th {
            background: #f8fafc;
            color: #718096;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.05em;
            padding: 15px 20px;
            text-align: left;
            border-bottom: 2px solid #edf2f7;
        }

        td {
            padding: 15px 20px;
            border-bottom: 1px solid #edf2f7;
            font-size: 13px;
            vertical-align: middle;
        }

        .book-title { font-weight: bold; color: #2d3748; display: block; }
        .no-seri { color: var(--primary-blue); font-size: 12px; font-weight: 600; }

        /* BUTTONS */
        .btn-add {
            background: var(--success-green);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            display: flex;
            align-items: center; gap: 8px;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-edit { background: #f6ad55; }
        .btn-delete { background: #fc8181; }

    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <i class="fa fa-exchange-alt"></i> Kelola Data buku
    </div>

    <div class="profile-section">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin">
        <p>Admin Sistem</p>
    </div>

    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> Dashboard</a>
    <a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
    <a href="{{ route('buku.index') }}" class="active"><i class="fa fa-book"></i> Data Buku</a>
    <a href="{{ route('transaksi.index') }}"><i class="fa fa-file-invoice"></i> Data Transaksi</a>

    <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
        @csrf
        <button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
    </form>
</div>

<div class="main">
    <div class="top-nav">
        <span><i class="fa fa-bars"></i></span>
        <span><i class="fa fa-user-circle"></i> Administrator</span>
    </div>

    <div class="content">
        <div class="page-header">
            <h1>Daftar Buku Perpustakaan</h1>
            <a href="{{ route('buku.create') }}" class="btn-add">
                <i class="fa fa-plus"></i> Tambah Buku Baru
            </a>
        </div>

        <div class="search-container">
            <form action="{{ route('buku.index') }}" method="GET" class="search-box-wrapper">
                <input type="text" name="search" placeholder="Cari Judul, No Seri, atau Pengarang..." value="{{ request('search') }}">
                <button class="btn-filter"><i class="fa fa-search"></i> Filter Data</button>
            </form>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th width="50">NO</th>
                        <th>JUDUL BUKU & NO SERI</th>
                        <th>PENGARANG / PENERBIT</th>
                        <th>TAHUN</th>
                        <th>HAL</th>
                        <th class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($m_bukus as $i => $b)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <span class="no-seri">SN: {{ $b->no_seri }}</span>
                            <span class="book-title">{{ $b->judul }}</span>
                        </td>
                        <td>
                            <div>{{ $b->pengarang ?? '-' }}</div>
                            <small style="color: #a0aec0;">{{ $b->penerbit ?? '-' }}</small>
                        </td>
                        <td>{{ $b->tahun_terbit ?? '-' }}</td>
                        <td>{{ $b->jumlah_halaman ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('buku.edit', $b->buku_id) }}" class="btn-action btn-edit">
                                <i class="fa fa-pen"></i>
                            </a>
                            <form action="{{ route('buku.destroy', $b->buku_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-action btn-delete" onclick="return confirm('Yakin hapus?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px; color: #a0aec0;">
                            <i class="fa fa-info-circle" style="font-size: 24px; display: block; margin-bottom: 10px;"></i>
                            Data buku tidak ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>