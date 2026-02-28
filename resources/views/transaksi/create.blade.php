<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        .content {
            margin-left: 250px;
            padding: 50px;
        }

        .card {
            background: white;
            padding: 45px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            max-width: 1000px;
        }

        h2 {
            margin-bottom: 30px;
            color: #0f172a;
            font-size: 24px;
        }

        label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #334155;
        }

        select, input {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            font-size: 14px;
        }

        select[multiple] { height: 150px; }

        small {
            color: #64748b;
            margin-top: -10px;
            margin-bottom: 25px;
            display: block;
        }

        .btn {
            padding: 12px 20px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-primary { background: #0ea5e9; color: white; }
        .btn-back { background: #94a3b8; color: white; margin-left: 10px; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>📚 Perpustakaan</h2>

    <div class="profile">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
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

        <h2><i class="fa fa-plus-circle"></i> Tambah Transaksi</h2>

        <form method="POST" action="{{ route('transaksi.store') }}">
            @csrf

            <!-- 🔍 SEARCH ANGGOTA -->
            <label>Cari Anggota</label>
            <input type="text"
                   id="searchAnggota"
                   placeholder="Ketik nama siswa...">

            <label>Anggota</label>
            <select name="anggota_id" id="anggotaSelect" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggotas as $a)
                    <option value="{{ $a->id }}">{{ $a->nama }}</option>
                @endforeach
            </select>

            <label>Pilih Buku</label>
            <select name="buku_id[]" multiple required>
                @foreach($bukus as $b)
                    <option value="{{ $b->id }}">{{ $b->judul }}</option>
                @endforeach
            </select>
            <small>Gunakan CTRL / CMD untuk memilih lebih dari satu buku</small>

            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" required>

            <label>Batas Pengembalian</label>
            <input type="date" name="tanggal_kembali" required>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>

            <a href="{{ route('transaksi.index') }}" class="btn btn-back">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>

        </form>

    </div>
</div>

<!-- ✅ JAVASCRIPT SEARCH -->
<script>
document.getElementById('searchAnggota').addEventListener('keyup', function () {
    let keyword = this.value.toLowerCase();
    let options = document.querySelectorAll('#anggotaSelect option');

    options.forEach(option => {
        if (option.text.toLowerCase().includes(keyword) || option.value === "") {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    });
});
</script>

</body>
</html>