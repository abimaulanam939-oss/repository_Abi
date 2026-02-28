<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi - Perpustakaan Sekolah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body { background: #f1f5f9; }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px 15px;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .profile {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile img {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            border: 3px solid #38bdf8;
            margin-bottom: 10px;
        }

        .sidebar a {
            display: block;
            padding: 12px 15px;
            margin-bottom: 8px;
            color: #cbd5e1;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #38bdf8;
            color: white;
        }

        .sidebar i { margin-right: 10px; }

        .content {
            margin-left: 250px;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
            color: white;
        }

        .btn-primary { background: #0ea5e9; }
        .btn-warning { background: #f59e0b; }
        .btn-danger  { background: #ef4444; }
        .btn-success { background: #16a34a; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #0f172a;
            color: white;
        }

        table th,
        table td {
            padding: 12px;
            text-align: center;
            font-size: 14px;
        }

        table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-danger {
            background: #fee2e2;
            color: #dc2626;
        }

        /* SEARCH */
        .search-box {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }

        .search-box input {
            padding: 8px;
            width: 280px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>📚 Perpustakaan</h2>

    <div class="profile">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin">
        <p>Admin</p>
    </div>

    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
    <a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
    <a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
    <a href="{{ route('transaksi.index') }}" class="active">
        <i class="fa fa-exchange-alt"></i> Transaksi
    </a>
</div>

<div class="content">
    <div class="card">
        <div class="header">
            <h2><i class="fa fa-exchange-alt"></i> Data Transaksi</h2>
            <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Tambah
            </a>
        </div>

        <!-- 🔍 SEARCH -->
        <form action="{{ route('transaksi.index') }}" method="GET" class="search-box">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari nama siswa / judul buku / status">
            <button type="submit" class="btn btn-primary">Cari</button>

            @if(request('search'))
                <a href="{{ route('transaksi.index') }}" class="btn btn-danger">Reset</a>
            @endif
        </form>

        <table>
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Batas Kembali</th>
                <th>Tgl Dikembalikan</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>

            <tbody>
            @forelse ($transaksis as $key => $transaksi)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $transaksi->anggota->nama }}</td>
                    <td>
                        @foreach ($transaksi->detail as $detail)
                            {{ $detail->buku->judul }}<br>
                        @endforeach
                    </td>

                    <td>{{ $transaksi->tanggal_pinjam->format('d-m-Y') }}</td>
                    <td>{{ $transaksi->tanggal_kembali->format('d-m-Y') }}</td>
                    <td>
                        {{ $transaksi->tanggal_dikembalikan
                            ? $transaksi->tanggal_dikembalikan->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td>Rp {{ number_format($transaksi->denda ?? 0, 0, ',', '.') }}</td>

                    <td>
                        @if ($transaksi->status === 'dikembalikan')
                            <span class="badge badge-success">Sudah Kembali</span>
                        @else
                            <span class="badge badge-danger">Dipinjam</span>
                        @endif
                    </td>

                    <td>
                        <div style="display:flex;gap:6px;justify-content:center;flex-wrap:wrap">

                            @if ($transaksi->status === 'dipinjam')
                                <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Yakin ingin mengembalikan buku ini?')">
                                        Kembalikan
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin hapus data ini?')">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada data transaksi.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>