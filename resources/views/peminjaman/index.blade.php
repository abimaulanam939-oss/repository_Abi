<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background: #f4f6f9; color: #333; }
        
        /* Sidebar */
        .sidebar { width: 230px; background: #0b0a2a; min-height: 100vh; color: white; position: fixed; left: 0; top: 0; z-index: 1000; }
        .sidebar h2 { text-align: center; padding: 20px 0; font-size: 18px; border-bottom: 1px solid rgba(255,255,255,0.1); letter-spacing: 1px; }
        .profile { text-align: center; padding: 20px 0; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .profile img { width: 70px; height: 70px; border-radius: 50%; background: white; padding: 3px; object-fit: cover; }
        .profile p { margin-top: 10px; font-size: 14px; font-weight: 600; }
        .sidebar a { display: flex; align-items: center; gap: 12px; padding: 14px 20px; color: rgba(255,255,255,0.8); text-decoration: none; font-size: 14px; transition: 0.3s; }
        .sidebar a:hover { background: #1b1955; color: white; }
        .sidebar a.active { background: #3498db; color: white; border-left: 4px solid #fff; }
        
        /* Main Content */
        .main { margin-left: 230px; width: calc(100% - 230px); min-height: 100vh; }
        .navbar { background: white; padding: 15px 30px; font-weight: bold; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 999; }
        .content { padding: 30px; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }

        /* User Dropdown */
        .user-menu { position: relative; cursor: pointer; }
        .dropdown-content { display: none; position: absolute; right: 0; top: 35px; background: white; min-width: 160px; box-shadow: 0 8px 16px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; border: 1px solid #eee; }
        .dropdown-content button { width: 100%; text-align: left; padding: 12px 16px; border: none; background: none; cursor: pointer; color: #e74c3c; font-weight: 600; font-size: 13px; display: flex; align-items: center; gap: 10px; }
        .dropdown-content button:hover { background: #f8fafc; }
        
        /* Buttons & Table Styling */
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f4f6f9; padding-bottom: 15px; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; font-size: 13px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; color: white; transition: 0.2s; font-weight: 500; }
        .btn-add { background: #27ae60; } 
        .btn-kembali { background: #3498db; } 
        .btn-save { background: #f39c12; } 
        .btn-delete { background: #e74c3c; }
        
        .search-box { display: flex; gap: 10px; margin-bottom: 20px; background: #f8fafc; padding: 15px; border-radius: 8px; align-items: center; }
        .search-box input { padding: 10px 15px; width: 300px; border: 1px solid #ddd; border-radius: 6px; outline: none; }
        
        .table-responsive { overflow-x: auto; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; min-width: 1000px; }
        th { background: #f8fafc; color: #475569; padding: 15px 12px; font-size: 13px; text-align: left; border-bottom: 2px solid #e2e8f0; }
        td { padding: 15px 12px; font-size: 14px; border-bottom: 1px solid #f1f5f9; vertical-align: top; }
        
        .status { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: bold; }
        .dikembalikan { background: #dcfce7; color: #166534; }
        .denda { color: #e74c3c; font-weight: bold; }
        .badge-seri { display: inline-block; background: #e0f2fe; color: #0369a1; padding: 2px 8px; border-radius: 4px; font-weight: bold; font-size: 11px; margin-bottom: 4px; }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Perpustakaan</h2>
        <div class="profile">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Admin Profile">
            <p>Admin Sistem</p>
        </div>
        <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
        <a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
        <a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
        <a href="{{ route('peminjaman.index') }}" class="active"><i class="fa fa-file-lines"></i> Data Peminjaman</a>
    </div>

    <div class="main">
        <div class="navbar">
            <span><i class="fa fa-exchange-alt"></i> Kelola Peminjaman</span>
            
            <div class="user-menu" onclick="toggleDropdown()">
                <span><i class="fa fa-user-circle"></i> Administrator <i class="fa fa-caret-down"></i></span>
                <div class="dropdown-content" id="adminDropdown">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"><i class="fa fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="card">
                <div class="top-bar">
                    <h2>Daftar Peminjaman Siswa</h2>
                    <div style="display: flex; gap: 10px;">
                        <a href="{{ route('peminjaman.cetak') }}" target="_blank" class="btn" style="background: #e74c3c;">
                            <i class="fa fa-file-pdf"></i> Cetak PDF
                        </a>
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-add">
                            <i class="fa fa-plus"></i> Peminjaman baru
                        </a>
                    </div>
                </div>

                <form method="GET" action="{{ route('peminjaman.index') }}" class="search-box">
                    <input type="text" name="search" placeholder="Cari NIPD, Nama, atau Judul..." value="{{ request('search') }}">
                    <button type="submit" style="background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">
                        <i class="fa fa-search"></i> Filter Data
                    </button>
                    @if(request('search'))
                        <a href="{{ route('peminjaman.index') }}" class="btn" style="background: #94a3b8; color: white;">Reset</a>
                    @endif
                </form>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>NIPD & Anggota</th>
                                <th>Kelas / Jurusan</th>
                                <th width="250">Detail Buku & No Seri</th>
                                <th>Waktu Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Denda</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjaman as $i => $t)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>
                                    <small style="color: #64748b;">{{ $t->anggota->nipd ?? '-' }}</small><br>
                                    <strong>{{ $t->anggota->nama ?? 'Tidak Diketahui' }}</strong>
                                </td>
                                <td>
                                    {{ $t->anggota->kelas }}<br>
                                    <small style="color: #64748b;">{{ $t->anggota->jurusan }}</small>
                                </td>
                                <td>
                                    @foreach($t->detail as $d)
                                    <div style="margin-bottom:12px; border-left: 3px solid #3498db; padding-left: 10px;">
                                        <form action="{{ route('detail.update', $d->id_detail) }}" method="POST">
                                            @csrf @method('PUT')
                                            <span class="badge-seri">SN: {{ $d->no_seri ?? 'N/A' }}</span><br>
                                            <span style="font-size: 13px;">{{ $d->buku->judul ?? '-' }}</span><br>
                                            <div style="margin-top: 5px; display: flex; gap: 5px;">
                                                <select name="kondisi" style="padding: 4px; border-radius: 4px; border: 1px solid #cbd5e1; font-size: 11px;">
                                                    <option value="dipinjam" {{ $d->kondisi=='dipinjam'?'selected':'' }}>Dipinjam</option>
                                                    <option value="dikembalikan" {{ $d->kondisi=='dikembalikan'?'selected':'' }}>Kembali</option>
                                                    <option value="rusak" {{ $d->kondisi=='rusak'?'selected':'' }}>Rusak</option>
                                                    <option value="hilang" {{ $d->kondisi=='hilang'?'selected':'' }}>Hilang</option>
                                                </select>
                                                <button type="submit" class="btn btn-save" style="padding: 2px 6px;"><i class="fa fa-save" style="font-size: 10px;"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    @endforeach
                                </td>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d/m/Y') }}</td>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($t->tanggal_kembali)->format('d/m/Y') }}</strong><br>
                                    @if(now()->gt($t->tanggal_kembali) && $t->status=='dipinjam')
                                        <span style="color: #e11d48; font-size: 11px; font-weight: bold;">Terlambat</span>
                                    @endif
                                </td>
                                <td class="denda">Rp {{ number_format($t->denda, 0, ',', '.') }}</td>
                                <td>
                                    @if($t->status=='dipinjam')
                                        <a href="{{ route('peminjaman.kembalikan',$t->id_transaksi) }}" class="btn btn-kembali" onclick="return confirm('Proses pengembalian?')">
                                            <i class="fa fa-undo"></i> Kembalikan
                                        </a>
                                    @else
                                        <span class="status dikembalikan">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('peminjaman.destroy',$t->id_transaksi) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-delete" style="padding: 8px;" onclick="return confirm('Hapus transaksi?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="9" style="text-align: center; padding: 40px; color: #94a3b8;">Data tidak ditemukan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('adminDropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        window.onclick = function(event) {
            if (!event.target.closest('.user-menu')) {
                const d = document.getElementById('adminDropdown');
                if(d) d.style.display = 'none';
            }
        }
    </script>
</body>
</html>