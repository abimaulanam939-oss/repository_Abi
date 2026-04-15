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
        
        input[type="date"] { width:100%; padding:8px; margin-top:5px; margin-bottom:15px; border:1px solid #ccc; border-radius:5px; box-sizing: border-box; }
        
        .select2-container--default { margin-top: 5px; margin-bottom: 15px; width: 100% !important; }
        .select2-selection { min-height: 38px !important; border: 1px solid #ccc !important; }

        .info{ font-size:12px; color:#666; margin-top:-10px; margin-bottom:15px; }
        
        /* Notifikasi Styles */
        .alert { padding: 12px; border-radius: 5px; margin-bottom: 15px; font-size: 14px; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

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
            <div class="alert alert-danger">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf

            <label>Anggota</label>
            <select name="anggota_id" class="js-cari-anggota" required>
                <option value="">-- cari nama anggota --</option>
                @foreach($m_anggotas as $a)
                    <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                        {{ $a->nama }} ({{ $a->jurusan }})
                    </option>
                @endforeach
            </select>

            <label>Pilih Buku</label>
            <select name="buku_id[]" class="js-cari-buku" multiple="multiple" required>
                @foreach($m_bukus as $b)
                    <option value="{{ $b->buku_id }}" {{ (is_array(old('buku_id')) && in_array($b->buku_id, old('buku_id'))) ? 'selected' : '' }}>
                        [{{ $b->no_seri ?? 'No Seri -' }}] - {{ $b->judul }}
                    </option>
                @endforeach
            </select>

            <div class="info">
                * Ketik untuk mencari. Klik nama buku untuk memilih lebih dari satu.
            </div>

            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>

            <label>Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+3 days'))) }}" required>

            <button type="submit" class="btn btn-simpan" id="btnSubmit">
                <i class="fa fa-save"></i> Simpan Transaksi
            </button>

            <a href="{{ route('peminjaman.index') }}" class="btn-kembali">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-cari-anggota').select2({
            placeholder: "Cari nama anggota...",
            allowClear: true
        });

        $('.js-cari-buku').select2({
            placeholder: "Cari judul buku...",
            allowClear: true,
            closeOnSelect: false
        });

        // Mencegah double click saat submit
        $('form').on('submit', function() {
            $('#btnSubmit').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Memproses...');
        });
    });
</script>

</body>
</html>