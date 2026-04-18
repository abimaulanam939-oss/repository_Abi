<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Modern Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #334155;
        }
        .main-content {
            padding: 40px 20px;
        }
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            background: #ffffff;
        }
        .table thead th {
            background-color: #f1f5f9;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #64748b;
            border: none;
            padding: 15px 20px;
        }
        .table tbody td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: #64748b;
            font-weight: bold;
        }
        .badge-modern {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        .badge-admin { background: #e0f2fe; color: #0369a1; }
        .badge-petugas { background: #fef3c7; color: #92400e; }
        .badge-active { background: #dcfce7; color: #166534; }
        
        .btn-add {
            background-color: #4f46e5;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-add:hover {
            background-color: #4338ca;
            color: white;
            transform: translateY(-2px);
        }
        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            margin: 0 2px;
            transition: all 0.2s;
            border: none;
        }
        .action-edit { background: #f1f5f9; color: #475569; }
        .action-edit:hover { background: #e2e8f0; }
        .action-delete { background: #fee2e2; color: #dc2626; }
        .action-delete:hover { background: #fecaca; }
    </style>
</head>
<body>

<div class="container main-content">
    <div class="page-header">
        <div>
            <h2 class="fw-bold mb-1">Manajemen Pengguna</h2>
            <p class="text-muted small mb-0">Kelola hak akses admin dan petugas perpustakaan.</p>
        </div>
        <a href="{{ route('user.create') }}" class="btn btn-add shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-radius: 12px;">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3 d-flex flex-row align-items-center">
                <div class="user-avatar bg-primary text-white"><i class="fas fa-users"></i></div>
                <div>
                    <h6 class="mb-0 text-muted small">Total User</h6>
                    <span class="fw-bold h5 mb-0">{{ $users->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div class="fw-semibold text-dark">{{ $u->name }}</div>
                            </div>
                        </td>
                        <td><span class="text-muted">@</span>{{ $u->username }}</td>
                        <td>
                            @if($u->role == 'Admin')
                                <span class="badge-modern badge-admin">Administrator</span>
                            @else
                                <span class="badge-modern badge-petugas">Petugas</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge-modern badge-active">
                                <i class="fas fa-circle me-1" style="font-size: 8px;"></i> Aktif
                            </span>
                        </td>
                        <td class="text-end">

                            
                            <form action="{{ route('user.destroy', $u->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn action-delete" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                    <i class="fas fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <p class="text-muted small">Belum ada data pengguna.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white py-3 border-0">
            <a href="/home" class="text-decoration-none text-muted small fw-medium">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>