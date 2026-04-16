<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Anggota - Perpustakaan</title>
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
            background-color: white;
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
            background: #3498db;
            color: white;
        }

        .btn-save:hover { background: #2980b9; }

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
        <h2 class="title"><i class="fa fa-user-plus"></i> Tambah Data Anggota</h2>

        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf

            <label>NIPD</label>
            <input type="text" 
                   name="nipd" 
                   value="{{ old('nipd') }}" 
                   style="border: 1px solid @error('nipd') #e74c3c @else #ccc @enderror;"
                   placeholder="Masukkan NIPD anggota..." 
                   required>

            @error('nipd')
                <div style="color: #e74c3c; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-weight: bold;">
                    <i class="fa fa-exclamation-circle"></i> {{ $message }}
                </div>
            @enderror

            <label>Nama Lengkap</label>
            <input type="text" 
                   name="nama" 
                   value="{{ old('nama') }}" 
                   style="border: 1px solid @error('nama') #e74c3c @else #ccc @enderror;"
                   placeholder="Masukkan nama lengkap..." 
                   required>

            @error('nama')
                <div style="color: #e74c3c; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-weight: bold;">
                    <i class="fa fa-exclamation-circle"></i> {{ $message }}
                </div>
            @enderror

            <label>Kelas</label>
            <select name="kelas" required>
                <option value="" disabled {{ old('kelas') == '' ? 'selected' : '' }}>-- Pilih Kelas --</option>
                <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>X</option>
                <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>XI</option>
                <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>XII</option>
            </select>

            <label>Jurusan</label>
            <select name="jurusan" required>
                <option value="" disabled {{ old('jurusan') == '' ? 'selected' : '' }}>-- Pilih Jurusan --</option>
                <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak (RPL)</option>
                <option value="DKV" {{ old('jurusan') == 'DKV' ? 'selected' : '' }}>Desain komunikasi visual (DKV)</option>
                <option value="TKJ1" {{ old('jurusan') == 'TKJ1' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ1)</option>
                <option value="TKJ2" {{ old('jurusan') == 'TKJ2' ? 'selected' : '' }}>Teknik Komputer dan Jaringan (TKJ2)</option>
                <option value="BD1" {{ old('jurusan') == 'BD1' ? 'selected' : '' }}>Bisnis Digital (BD1)</option>
                <option value="BD2" {{ old('jurusan') == 'BD2' ? 'selected' : '' }}>Bisnis Digital (BD2)</option>
                <option value="BD3" {{ old('jurusan') == 'BD3' ? 'selected' : '' }}>Bisnis Digital (BD3)</option>
            </select>

            <div class="btn-group">
                <button type="submit" class="btn btn-save">
                    <i class="fa fa-save"></i> Simpan Anggota
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