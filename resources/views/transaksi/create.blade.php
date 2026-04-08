<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body{ font-family:Arial; background:#f4f6f9; margin:0; }
        .header{ background:#2c3e50; color:white; padding:15px; }
        .container{ width:600px; margin:auto; margin-top:40px; }
        .card{ background:white; padding:25px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
        label{ font-weight:bold; }
        input,select{ width:100%; padding:8px; margin-top:5px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px; box-sizing: border-box; }
        select[multiple]{ height:150px; }
        .info{ font-size:12px; color:#666; margin-top:-10px; margin-bottom:15px; }
        .alert{ background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        .btn{ padding:10px 15px; border:none; border-radius:5px; cursor:pointer; }
        .btn-simpan{ background:#27ae60; color:white; }
        .btn-kembali{ background:#e74c3c; color:white; text-decoration:none; padding:10px 15px; display: inline-block; }
    </style>
</head>
<body>

<div class="header">
    <h2>📚 Tambah Transaksi Peminjaman</h2>
</div>

<div class="container">
    <div class="card">
        
        <!-- Tambahan: Alert untuk melihat error jika validasi gagal -->
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf

            <label>Anggota</label>
            <select name="anggota_id" required>
                <option value="">-- pilih anggota --</option>
                @foreach($m_anggotas as $a)
                    {{-- Di SQL kolomnya 'id', jadi tetap $a->id --}}
                    <option value="{{ $a->id }}">{{ $a->nama }} ({{ $a->jurusan }})</option>
                @endforeach
            </select>

            <label>Pilih Buku</label>
            <select name="buku_id[]" multiple required>
                @foreach($m_bukus as $b)
                    {{-- PERBAIKAN: Gunakan $b->buku_id sesuai SQL kamu --}}
                    <option value="{{ $b->buku_id }}">
                        {{ $b->no_seri }} - {{ $b->judul }}
                    </option>
                @endforeach
            </select>

            <div class="info">
                Gunakan <b>CTRL + Klik</b> untuk memilih lebih dari satu buku
            </div>

            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" required>

            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime('+3 days')) }}" required>

            <button type="submit" class="btn btn-simpan">
                <i class="fa fa-save"></i> Simpan Transaksi
            </button>

            <a href="{{ route('transaksi.index') }}" class="btn-kembali">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </form>

    </div>
</div>

</body>
</html>