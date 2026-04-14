<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Buku - Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #eef1f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .content {
            width: 100%;
            padding: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 550px;
            margin: auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        h2.title {
            text-align: center;
            color: #1b263b;
            margin-bottom: 25px;
            font-size: 24px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 10px;
        }

        .btn {
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            flex: 1;
            text-align: center;
            text-decoration: none;
            font-size: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-save {
            background: #f39c12;
            color: white;
        }

        .btn-save:hover { 
            background: #e67e22; 
        }

        .btn-back {
            background: #95a5a6;
            color: white;
        }

        .btn-back:hover {
            background: #7f8c8d;
        }
    </style>
</head>
<body>

<div class="content">
    <div class="card">
        <h2 class="title"><i class="fa fa-book-open"></i> Edit Data Buku</h2>

        <form action="{{ route('buku.update', $m_bukus->buku_id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Judul Buku</label>
            <input type="text" name="judul" value="{{ $m_bukus->judul }}" placeholder="Masukkan judul buku" required>

            <label>No Seri</label>
            <input type="text" name="no_seri" value="{{ $m_bukus->no_seri }}" placeholder="Masukkan nomor seri" required>

            <label>Pengarang</label>
            <input type="text" name="pengarang" value="{{ $m_bukus->pengarang }}" placeholder="Nama pengarang" required>

            <label>Penerbit</label>
            <input type="text" name="penerbit" value="{{ $m_bukus->penerbit }}" placeholder="Nama penerbit" required>

            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" value="{{ $m_bukus->tahun_terbit }}" placeholder="Tahun terbit" required>

            <label>Jumlah Halaman</label>
            <input type="number" name="jumlah_halaman" value="{{ $m_bukus->jumlah_halaman }}" placeholder="Total halaman" required>

            <div class="btn-group">
                <button type="submit" class="btn btn-save">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>

                <a href="{{ route('buku.index') }}" class="btn btn-back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>