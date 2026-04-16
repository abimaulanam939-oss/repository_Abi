<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perpustakaan Digital</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-body: #f4f7fe;
            --sidebar-dark: #0b1120;
            --primary: #4318ff;
            --blue-card: linear-gradient(135deg, #868CFF 0%, #4318FF 100%);
            --yellow-card: linear-gradient(135deg, #FEC163 0%, #DE911D 100%);
            --red-card: linear-gradient(135deg, #FF9494 0%, #E74C3C 100%);
            --white: #ffffff;
        }

        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
        }

        body {
            display: flex;
            background: var(--bg-body);
            color: #2B3674;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: var(--sidebar-dark);
            color: white;
            position: fixed;
            transition: 0.3s;
        }

        .sidebar .brand {
            padding: 25px;
            font-size: 1.3rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .profile-section {
            text-align: center;
            padding: 30px 10px;
        }

        .profile-section img {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.1);
            padding: 4px;
            background: #fff;
            object-fit: cover;
        }

        .profile-section p {
            margin-top: 12px;
            font-weight: 600;
            font-size: 15px;
        }

        .sidebar a, .sidebar button {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            color: #a3adc2;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
            background: none; border: none; width: 100%; cursor: pointer;
            text-align: left;
        }

        .sidebar a:hover, .sidebar .active {
            background: rgba(255,255,255,0.05);
            color: white;
            border-left: 5px solid #4318ff;
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        .top-nav {
            background: transparent;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content {
            padding: 0 30px 30px 30px;
        }

        .welcome-box {
            margin-bottom: 30px;
        }

        .welcome-box h1 {
            font-size: 28px;
            font-weight: 700;
            color: #2B3674;
        }

        .welcome-box p {
            color: #707EAE;
            font-size: 14px;
        }

        /* DASHBOARD CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .stat-card {
            background: var(--white);
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0px 18px 40px rgba(112, 144, 176, 0.12);
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: 0.3s;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 24px;
            color: white;
        }

        .bg-gradient-red { background: var(--red-card); }
        .bg-gradient-yellow { background: var(--yellow-card); }
        .bg-gradient-blue { background: var(--blue-card); }

        .stat-info h3 {
            font-size: 24px;
            font-weight: 800;
            color: #2B3674;
            line-height: 1;
        }

        .stat-info p {
            color: #a3aed0;
            font-size: 14px;
            font-weight: 500;
            margin-top: 5px;
        }

        .card-decoration {
            position: absolute;
            right: -20px;
            bottom: -20px;
            font-size: 80px;
            opacity: 0.05;
            transform: rotate(-15deg);
        }

        /* STYLE TABEL HISTORI */
        .history-card {
            background: var(--white);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 18px 40px rgba(112, 144, 176, 0.12);
            margin-top: 30px;
        }

        .history-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #2B3674;
            margin-bottom: 25px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            text-align: left;
            color: #a3aed0;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            padding-bottom: 15px;
            border-bottom: 1px solid #f4f7fe;
        }

        .history-table td {
            padding: 15px 0;
            font-size: 14px;
            font-weight: 700;
            color: #2B3674;
            border-bottom: 1px solid #f4f7fe;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
        }
        .bg-light-success { background: #e6fffa; color: #05cd99; }
        .bg-light-warning { background: #fff9e6; color: #ffb547; }

    </style>
</head>

<body>

    <div class="sidebar">
        <div class="brand">
            <i class="fa fa-book-open"></i> PERPUS-ID
        </div>

        <div class="profile-section">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin">
            <p>Admin Sistem</p>
        </div>

        <a href="{{ route('home') }}" class="active"><i class="fa fa-th-large"></i> Dashboard</a>
        <a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
        <a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
        <a href="{{ route('peminjaman.index') }}"><i class="fa fa-file-invoice"></i> Data Peminjaman</a>

        <form action="{{ route('logout') }}" method="POST" style="margin-top: 30px;">
            @csrf
            <button type="submit"><i class="fa fa-sign-out-alt"></i> Logout Sistem</button>
        </form>
    </div>

    <div class="main">
        <div class="top-nav">
            <div class="breadcrumb">
                <span style="color: #707EAE;">Pages /</span>
                <span style="font-weight: 600;"> Dashboard</span>
            </div>
            <div style="background: white; padding: 10px 20px; border-radius: 30px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                <i class="fa fa-user-circle" style="color: var(--primary);"></i> 
                <span style="font-weight: 700; font-size: 14px; margin-left: 5px;">Administrator</span>
            </div>
        </div>

        <div class="content">
            <div class="welcome-box">
                <h1>Selamat Datang Kembali! 👋</h1>
                <p>Berikut adalah ringkasan aktivitas perpustakaan hari ini.</p>
            </div>

            <div class="stats-grid">
                <a href="{{ route('anggota.index') }}" class="stat-card">
                    <div class="icon-box bg-gradient-red">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalAnggota }}</h3>
                        <p>Total Anggota</p>
                    </div>
                    <i class="fa fa-users card-decoration"></i>
                </a>

                <a href="{{ route('buku.index') }}" class="stat-card">
                    <div class="icon-box bg-gradient-yellow">
                        <i class="fa fa-book"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalBuku }}</h3>
                        <p>Koleksi Buku</p>
                    </div>
                    <i class="fa fa-book card-decoration"></i>
                </a>

                <a href="{{ route('peminjaman.index') }}" class="stat-card">
                    <div class="icon-box bg-gradient-blue">
                        <i class="fa fa-exchange-alt"></i>
                    </div>
                    <div class="stat-info">
                        <h3>{{ $totalPeminjaman }}</h3>
                        <p>Total Peminjaman</p>
                    </div>
                    <i class="fa fa-exchange-alt card-decoration"></i>
                </a>
            </div>

            <div class="history-card">
                <h2>Histori Peminjaman Terbaru</h2>
                <div style="overflow-x: auto;">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPeminjaman as $pinjam)
                            <tr>
                                <td>{{ $pinjam->anggota->nama ?? 'Umum' }}</td>
                                
                                <td>
                                    @if($pinjam->detail->isNotEmpty())
                                        {{ $pinjam->detail->first()->buku->judul ?? '-' }}
                                        @if($pinjam->detail->count() > 1)
                                            <span style="color: #4318ff; font-size: 11px;">
                                                (+{{ $pinjam->detail->count() - 1 }} buku)
                                            </span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>

                                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}</td>

                                <td>
                                    @if($pinjam->status == 'dikembalikan')
                                        <span class="badge bg-light-success">Dikembalikan</span>
                                    @else
                                        <span class="badge bg-light-warning">Dipinjam</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: #a3aed0; padding: 40px 0;">
                                    Tidak ada data peminjaman terbaru.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
    </div>

</body>
</html>