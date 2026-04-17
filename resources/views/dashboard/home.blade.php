<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Perpustakaan Digital</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            display: flex;
            background: var(--bg-body);
            color: #2B3674;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: var(--sidebar-dark);
            color: white;
            position: fixed;
            z-index: 100;
        }

        .sidebar .brand {
            padding: 25px;
            font-size: 1.3rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .profile-section {
            text-align: center;
            padding: 30px 10px;
        }

        .profile-section img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,0.1);
            background: #fff;
            object-fit: cover;
        }

        .profile-section p {
            margin-top: 12px;
            font-weight: 600;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            color: #a3adc2;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .sidebar a:hover, .sidebar .active {
            background: rgba(255,255,255,0.05);
            color: white;
            border-left: 5px solid var(--primary);
        }

        /* MAIN CONTENT */
        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            display: flex;
            flex-direction: column;
        }

        /* TOP NAV & DROPDOWN */
        .top-nav {
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-menu {
            position: relative;
            display: inline-block;
        }

        .admin-box { 
            background: white; 
            padding: 8px 18px; 
            border-radius: 30px; 
            box-shadow: 0 4px 10px rgba(0,0,0,0.05); 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            cursor: pointer;
            transition: 0.3s;
        }

        .admin-box:hover { background: #f8f9ff; }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 110%;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
            border-radius: 12px;
            z-index: 1000;
            overflow: hidden;
            border: 1px solid #f0f0f0;
        }

        .dropdown-content button {
            width: 100%;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #2B3674;
            font-size: 14px;
            font-weight: 700;
            border: none;
            background: none;
            cursor: pointer;
            text-align: left;
            transition: 0.2s;
        }

        .dropdown-content button:hover {
            background-color: #fff5f5;
            color: #e74c3c;
        }

        .admin-menu:hover .dropdown-content {
            display: block;
            animation: fadeIn 0.2s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* CONTENT STYLES */
        .content { padding: 0 30px 30px 30px; }
        .welcome-box { margin-bottom: 30px; }
        .welcome-box h1 { font-size: 28px; font-weight: 700; }
        
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .stat-card { 
            background: var(--white); padding: 25px; border-radius: 20px; 
            box-shadow: 0px 10px 30px rgba(112, 144, 176, 0.08); 
            display: flex; align-items: center; text-decoration: none; transition: 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); }
        .icon-box { width: 56px; height: 56px; border-radius: 15px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 22px; color: white; }
        
        .bg-gradient-red { background: var(--red-card); }
        .bg-gradient-yellow { background: var(--yellow-card); }
        .bg-gradient-blue { background: var(--blue-card); }

        .stat-info h3 { font-size: 24px; font-weight: 800; }
        .stat-info p { color: #a3aed0; font-size: 14px; }

        .history-card { 
            background: var(--white); padding: 30px; border-radius: 20px; 
            box-shadow: 0px 10px 30px rgba(112, 144, 176, 0.08); margin-top: 30px; 
        }
        .history-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .history-table th { text-align: left; color: #a3aed0; font-size: 12px; text-transform: uppercase; padding-bottom: 15px; border-bottom: 1px solid #f4f7fe; }
        .history-table td { padding: 15px 0; font-size: 14px; font-weight: 700; border-bottom: 1px solid #f4f7fe; }
        
        .badge { padding: 6px 12px; border-radius: 10px; font-size: 11px; }
        .bg-light-success { background: #e6fffa; color: #05cd99; }
        .bg-light-warning { background: #fff9e6; color: #ffb547; }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="brand"><i class="fa fa-book-open"></i> PERPUS-ID</div>
        <div class="profile-section">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin">
            <p>Admin Sistem</p>
        </div>
        <a href="{{ route('home') }}" class="active"><i class="fa fa-th-large"></i> Dashboard</a>
        <a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
        <a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
        <a href="{{ route('peminjaman.index') }}"><i class="fa fa-file-invoice"></i> Data Peminjaman</a>
    </div>

    <div class="main">
        <div class="top-nav">
            <div class="breadcrumb">
                <span style="color: #707EAE;">Pages /</span>
                <span style="font-weight: 600;"> Dashboard</span>
            </div>

            <div class="admin-menu">
                <div class="admin-box">
                    <i class="fa fa-user-circle" style="color: var(--primary); font-size: 18px;"></i> 
                    <span style="font-weight: 700; font-size: 14px;">Administrator</span>
                    <i class="fa fa-chevron-down" style="font-size: 10px; color: #a3aed0;"></i>
                </div>
                
                <div class="dropdown-content">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="fa fa-sign-out-alt" style="color: #e74c3c;"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="welcome-box">
                <h1>Selamat Datang Kembali! 👋</h1>
                <p style="color: #707EAE;">Berikut adalah ringkasan aktivitas perpustakaan hari ini.</p>
            </div>

            <div class="stats-grid">
                <a href="{{ route('anggota.index') }}" class="stat-card">
                    <div class="icon-box bg-gradient-red"><i class="fa fa-users"></i></div>
                    <div class="stat-info"><h3>{{ $totalAnggota }}</h3><p>Total Anggota</p></div>
                </a>
                <a href="{{ route('buku.index') }}" class="stat-card">
                    <div class="icon-box bg-gradient-yellow"><i class="fa fa-book"></i></div>
                    <div class="stat-info"><h3>{{ $totalBuku }}</h3><p>Koleksi Buku</p></div>
                </a>
                <a href="{{ route('peminjaman.index') }}" class="stat-card">
                    <div class="icon-box bg-gradient-blue"><i class="fa fa-exchange-alt"></i></div>
                    <div class="stat-info"><h3>{{ $totalPeminjaman }}</h3><p>Peminjaman</p></div>
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
                                <td>{{ $pinjam->detail->first()->buku->judul ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_pinjam)->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $pinjam->status == 'dikembalikan' ? 'bg-light-success' : 'bg-light-warning' }}">
                                        {{ ucfirst($pinjam->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" style="text-align: center; color: #a3aed0; padding: 40px 0;">Tidak ada data peminjaman terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>