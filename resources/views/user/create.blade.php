<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna - Modern Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 500px;
            background: #ffffff;
            overflow: hidden;
        }
        .card-header {
            background: #4f46e5;
            color: white;
            padding: 30px;
            text-align: center;
            border: none;
        }
        .card-body {
            padding: 40px;
        }
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        .btn-save {
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            margin-top: 20px;
            transition: all 0.3s;
        }
        .btn-save:hover {
            background-color: #4338ca;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }
        .btn-back {
            text-align: center;
            margin-top: 20px;
        }
        .btn-back a {
            color: #64748b;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .btn-back a:hover {
            color: #4f46e5;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h4 class="mb-1 fw-bold">Tambah Pengguna</h4>
        <p class="mb-0 opacity-75 small">Lengkapi data untuk membuat akun baru</p>
    </div>
    
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Budi Santoso" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">@</span>
                    <input type="text" name="username" id="username" class="form-control border-start-0" style="border-radius: 0 12px 12px 0;" placeholder="username" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role / Hak Akses</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="" disabled selected>Pilih role...</option>
                    <option value="Petugas">Petugas</option>
                    <option value="Admin">Administrator</option>
                </select>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-save shadow-sm">
                    <i class="fas fa-user-plus me-2"></i> Simpan Data Pengguna
                </button>
            </div>

            <div class="btn-back">
                <a href="{{ route('user.index') }}">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>