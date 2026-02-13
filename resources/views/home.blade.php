<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Perpustakaan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    background:#f5f6fa;
}

/* SIDEBAR */
.sidebar{
    width:250px;
    height:100vh;
    background:#0f0c29;
    color:white;
    position:fixed;
    transition:0.3s;
}

.sidebar.hide{
    margin-left:-250px;
}

.sidebar h3{
    padding:20px;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    transition:0.2s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.1);
}

.submenu{
    display:none;
    background:#1b173f;
}

.submenu a{
    padding-left:40px;
}

/* CONTENT */
.content{
    margin-left:250px;
    transition:0.3s;
}

.content.full{
    margin-left:0;
}

/* ICON BULAT */
.icon-circle{
    width:60px;
    height:60px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:25px;
    color:white;
}

/* HEADER BOX */
.header-box{
    background:#4e6a95;
    color:white;
    padding:15px;
    font-weight:bold;
    margin-bottom:15px;
}

/* BUTTON */
.btn-yellow{
    background:#f4c430;
    color:white;
    border-radius:25px;
    padding:15px 30px;
    font-weight:bold;
}

/* NOTIF */
.notif{
    padding:15px;
    border-radius:8px;
    margin-bottom:10px;
    position:relative;
}

.close-btn{
    position:absolute;
    right:10px;
    top:10px;
    cursor:pointer;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="sidebar" id="sidebar">
    <h3>Perpustakaan</h3>

    <div class="text-center mb-3">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="80">
        <p>admin</p>
    </div>

  <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
<a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
<a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>

    <a href="#" onclick="toggleSubmenu()">
        <i class="fa fa-exchange-alt"></i> Transaksi
    </a>

    <div class="submenu" id="submenu">
        <a href="#">Peminjaman</a>
        <a href="#">Pengembalian</a>
        <a href="#">Tambah Transaksi</a>
    </div>

    <a href="#"><i class="fa fa-user"></i> Data Admin</a>
</div>


<div class="content p-4" id="content">

    <!-- TOGGLE -->
    <button class="btn mb-3" onclick="toggleSidebar()">
        <i class="fa fa-bars fa-2x"></i>
    </button>

    <!-- STATISTIK -->
    <div class="row text-center mb-4">

        <div class="col-md-3">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="icon-circle bg-danger">
                    <i class="fa fa-user"></i>
                </div>
                <div>
                    <h3>1</h3>
                    <small>Total Anggota</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="icon-circle bg-warning">
                    <i class="fa fa-book"></i>
                </div>
                <div>
                    <h3>1</h3>
                    <small>Total Buku</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="icon-circle bg-info">
                    <i class="fa fa-sync"></i>
                </div>
                <div>
                    <h3>1</h3>
                    <small>Total Transaksi</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="icon-circle bg-success">
                    <i class="fa fa-users"></i>
                </div>
                <div>
                    <h3>0</h3>
                    <small>Total Pengunjung</small>
                </div>
            </div>
        </div>

    </div>

    <!-- DAFTAR BACAAN -->
    <div class="header-box">
        DAFTAR BACAAN PERPUSTAKAAN
    </div>

    <div class="card p-3 mb-3 d-flex justify-content-between align-items-center">
        <div>
            <img src="https://cdn-icons-png.flaticon.com/512/29/29302.png" width="40">
            <span class="ms-2">Atomic Habits</span>
        </div>
        <span class="badge bg-purple" style="background:purple;">
            2026/2/28
        </span>
    </div>

    <button class="btn btn-yellow mb-4">Lihat Buku Bacaan</button>

    <!-- BOTTOM SECTION -->
    <div class="row">

        <!-- NOTIF -->
        <div class="col-md-6">
            <div class="header-box">PEMBERITAHUAN</div>

            <div class="notif bg-danger text-white">
                <span class="close-btn" onclick="this.parentElement.style.display='none'">x</span>
                <strong>Siswa.</strong> Telah terdaftar menjadi anggota perpustakaan
            </div>

            <div class="notif bg-success text-white">
                <span class="close-btn" onclick="this.parentElement.style.display='none'">x</span>
                <strong>Admin.</strong> Telah ditambahkan menjadi admin baru
            </div>

            <div class="notif bg-info text-white">
                <span class="close-btn" onclick="this.parentElement.style.display='none'">x</span>
                <strong>Atomic Habits.</strong> Buku bacaan baru tersedia
            </div>
        </div>

        <!-- ANGGOTA BARU -->
        <div class="col-md-6">
            <div class="header-box">DAFTAR ANGGOTA BARU</div>

            <div class="card p-3 mt-2 d-flex align-items-center gap-3">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" width="40">
                Atomic Habits
            </div>

            <button class="btn btn-info mt-3">DATA ANGGOTA</button>
        </div>

    </div>

</div>


<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("hide");
    document.getElementById("content").classList.toggle("full");
}

function toggleSubmenu(){
    let submenu = document.getElementById("submenu");
    submenu.style.display = submenu.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>
