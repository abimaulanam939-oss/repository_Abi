<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body{ font-family:Arial; background:#f4f6f9; margin:0; }
        .header{ background:#2c3e50; color:white; padding:15px; }
        .container{ width:600px; margin:auto; margin-top:40px; margin-bottom: 50px; }
        .card{ background:white; padding:25px; border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
        label{ font-weight:bold; display: block; margin-top: 10px; }
        
        /* Input standar */
        input[type="date"] { width:100%; padding:8px; margin-top:5px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px; box-sizing: border-box; }
        
        /* Penyesuaian agar Select2 rapi */
        .select2-container--default { margin-top: 5px; margin-bottom: 15px; width: 100% !important; }
        .select2-selection { min-height: 38px !important; border: 1px solid #ccc !important; }

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
            <select name="anggota_id" class="js-cari-anggota" required>
                <option value="">-- cari nama anggota --</option>
                @foreach($m_anggotas as $a)
                    <option value="{{ $a->id }}">{{ $a->nama }} ({{ $a->jurusan }})</option>
                @endforeach
            </select>

            <label>Pilih Buku</label>
            <select name="buku_id[]" class="js-cari-buku" multiple="multiple" required>
                @foreach($m_bukus as $b)
                    <option value="{{ $b->buku_id }}">
                        [{{ $b->no_seri ?? 'No Seri -' }}] - {{ $b->judul }}
                    </option>
                @endforeach
            </select>

            <div class="info">
                * Ketik untuk mencari. Klik nama buku untuk memilih lebih dari satu.
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Search untuk Anggota (Satu pilihan)
        $('.js-cari-anggota').select2({
            placeholder: "Cari nama anggota...",
            allowClear: true
        });

        // Search untuk Buku (Bisa pilih banyak)
        $('.js-cari-buku').select2({
            placeholder: "Cari judul buku...",
            allowClear: true,
            closeOnSelect: false // Supaya dropdown tidak tertutup saat pilih banyak
        });
    });
</script>

</body>
</html>