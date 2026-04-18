<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Anggota - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f4f6f9;
            --sidebar-dark: #0b1120;
            --primary-blue: #3498db;
            --success-green: #2ecc71;
            --warning-orange: #f6ad55;
            --danger-red: #fc8181;
            --text-gray: #718096;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }

        body { display: flex; background: var(--bg-body); color: #333; overflow-x: hidden; }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: var(--sidebar-dark);
            color: white;
            min-height: 100vh;
            position: fixed;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .sidebar .brand {
            padding: 20px;
            font-size: 1.2rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
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
            border: 2px solid rgba(255,255,255,0.2);
            padding: 3px;
            background: #fff;
            object-fit: cover;
        }

        .profile-section p {
            margin-top: 10px;
            font-weight: 600;
            font-size: 14px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 25px;
            color: #a0aec0;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover, .sidebar a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--primary-blue);
        }

        /* MAIN CONTENT */
        .main { 
            margin-left: 240px; 
            width: calc(100% - 240px); 
            transition: all 0.3s ease;
        }

        .top-nav {
            background: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        /* USER MENU DROPDOWN */
        .user-menu {
            position: relative;
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 6px;
            transition: 0.2s;
        }

        .user-menu:hover { background: #f8fafc; }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 45px;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #eee;
        }

        .dropdown-content button {
            color: #333;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        .dropdown-content button:hover { background-color: #fff5f5; color: #e53e3e; }

        /* PAGE CONTENT */
        .content { padding: 30px; }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-header h1 { font-size: 22px; color: #2d3748; }

        /* SEARCH BAR */
        .search-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .search-form { display: flex; max-width: 500px; }

        .search-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 6px 0 0 6px;
            outline: none;
        }

        .btn-filter {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 0 20px;
            border-radius: 0 6px 6px 0;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
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
            color: var(--text-gray);
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 700;
            padding: 15px 20px;
            text-align: left;
            border-bottom: 2px solid #edf2f7;
        }

        td { padding: 15px 20px; border-bottom: 1px solid #edf2f7; font-size: 14px; }

        /* BUTTONS */
        .btn-add {
            background: var(--success-green);
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
        }

        .btn-add:hover { opacity: 0.9; transform: translateY(-1px); }

        .action-group { display: flex; gap: 8px; justify-content: center; }

        .btn-action {
            width: 34px; height: 34px;
            display: inline-flex;
            align-items: center; justify-content: center;
            border-radius: 8px; color: white; border: none; cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
        }

        .btn-edit { background: var(--warning-orange); }
        .btn-delete { background: var(--danger-red); }
        .btn-action:hover { opacity: 0.8; transform: scale(1.05); }

        /* UTILS */
        .text-center { text-align: center; }
        .sidebar-hidden { transform: translateX(-240px); }
        .main-full { margin-left: 0; width: 100%; }

    </style>
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="brand">
        <i class="fa fa-book-reader"></i> Perpustakaan
    </div>

    <div class="profile-section">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin">
        <p>Admin Sistem</p>
    </div>
<nav>
    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> Dashboard</a>
    <a href="{{ route('anggota.index') }}" class="{{ request()->is('anggota*') ? 'active' : '' }}"><i class="fa fa-users"></i> Data Anggota</a>
    <a href="{{ route('buku.index') }}" class="{{ request()->is('buku*') ? 'active' : '' }}"><i class="fa fa-book"></i> Data Buku</a>
    <a href="{{ route('peminjaman.index') }}" class="{{ request()->is('peminjaman*') ? 'active' : '' }}"><i class="fa fa-file-invoice"></i> Data Peminjaman</a>
    
    <a href="{{ route('user.index') }}" class="{{ request()->is('user*') ? 'active' : '' }}">
        <i class="fa fa-user-shield"></i> Data User
    </a>
</nav>
</aside>

<main class="main" id="mainContent">
    <header class="top-nav">
        <span style="cursor: pointer; font-size: 1.2rem; color: #4a5568;" onclick="toggleSidebar()">
            <i class="fa fa-bars"></i>
        </span>
        
        <div class="user-menu" id="userDropdownTrigger">
            <span style="font-weight: 600; font-size: 14px;">
                <i class="fa fa-user-circle" style="color: var(--primary-blue);"></i> Administrator <i class="fa fa-caret-down"></i>
            </span>
            <div class="dropdown-content" id="myDropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="content">
        <div class="page-header">
            <h1>Daftar Anggota Perpustakaan</h1>
            <a href="{{ route('anggota.create') }}" class="btn-add">
                <i class="fa fa-plus"></i> Tambah Anggota Baru
            </a>
        </div>

        <div class="search-container">
            <form action="{{ route('anggota.index') }}" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Cari NIPD, Nama, atau Kelas..." value="{{ request('search') }}">
                <button type="submit" class="btn-filter"><i class="fa fa-search"></i> Filter</button>
            </form>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th width="60" class="text-center">NO</th>
                        <th>NIPD & NAMA</th>
                        <th>KELAS / JURUSAN</th>
                        <th width="120" class="text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggotas as $i => $a)
                    <tr>
                        <td class="text-center" style="color: var(--text-gray);">{{ $i + 1 }}</td>
                        <td>
                            <div style="color: var(--primary-blue); font-weight: 700; font-size: 11px; letter-spacing: 0.5px;">{{ $a->nipd ?? '-' }}</div>
                            <div style="font-weight: 600; color: #2d3748; margin-top: 2px;">{{ $a->nama }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 600;">{{ $a->kelas }}</div>
                            <div style="color: var(--text-gray); font-size: 12px;">{{ $a->jurusan }}</div>
                        </td>
                        <td>
                            <div class="action-group">
                                <a href="{{ route('anggota.edit', $a->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus permanen anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center" style="padding: 50px; color: #a0aec0;">
                            <i class="fa fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                            Data tidak ditemukan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    // Fungsi untuk Toggle Sidebar
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');
        sidebar.classList.toggle('sidebar-hidden');
        main.classList.toggle('main-full');
    }

    // Fungsi untuk Dropdown Administrator
    const dropdownTrigger = document.getElementById('userDropdownTrigger');
    const dropdownMenu = document.getElementById('myDropdown');

    dropdownTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    // Menutup dropdown jika klik di luar elemen
    window.onclick = function(event) {
        if (!event.target.closest('#userDropdownTrigger')) {
            dropdownMenu.style.display = 'none';
        }
    }
</script>

</body>
</html>