<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Anggota - Perpustakaan</title>
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
            margin-bottom: 25px;
            color: #1b263b;
            text-align: center;
            font-size: 24px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            outline: none;
            font-size: 14px;
            background-color: white; /* Menjaga konsistensi warna select */
        }

        input:focus, select:focus {
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
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            flex: 1;
            font-size: 15px;
        }

        .btn-save {
            background: #2ecc71;
            color: white;
        }

        .btn-save:hover { background: #27ae60; }

        .btn-back {
            background: #95a5a6;
            color: white;
        }

        .btn-back:hover { background: #7f8c8d; }
    </style>
</head>
<body>

<div class="content">
    <div class="card">

        <h2 class="title"><i class="fa fa-user-edit"></i> Edit Data Anggota</h2>

        <form action="{{ route('anggota.update', $m_anggotas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>NIPD</label>
            <input type="text" 
                   name="nipd" 
                   value="{{ $m_anggotas->nipd }}" 
                   placeholder="Masukkan NIPD..." 
                   required>

            <label>Nama Lengkap</label>
            <input type="text"
                   name="nama"
                   value="{{ $m_anggotas->nama }}"
                   placeholder="Masukkan nama lengkap..."
                   required>

            <label>Kelas</label>
            <select name="kelas" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="X" {{ $m_anggotas->kelas == 'X' ? 'selected' : '' }}>X</option>
                <option value="XI" {{ $m_anggotas->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                <option value="XII" {{ $m_anggotas->kelas == 'XII' ? 'selected' : '' }}>XII</option>
            </select>

            <label>Jurusan</label>
            <select name="jurusan" required>
                <option value="">-- Pilih Jurusan --</option>
                <option value="RPL" {{ $m_anggotas->jurusan == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                <option value="TKJ" {{ $m_anggotas->jurusan == 'TKJ' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ)</option>
                <option value="BD" {{ $m_anggotas->jurusan == 'BD' ? 'selected' : '' }}>Bisnis Digital (BD)</option>
                <option value="MPLB" {{ $m_anggotas->jurusan == 'MPLB' ? 'selected' : '' }}>Manajemen Perkantoran & Layanan Bisnis (MPLB)</option>
                <option value="AK" {{ $m_anggotas->jurusan == 'AK' ? 'selected' : '' }}>Akuntansi (AK)</option>
            </select>

            <div class="btn-group">
                <button type="submit" class="btn btn-save">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>

                <a href="{{ route('anggota.index') }}" class="btn btn-back">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>

        </form>

    </div>
</div>

</body>
</html>