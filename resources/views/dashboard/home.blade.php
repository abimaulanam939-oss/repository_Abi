<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Perpustakaan</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    display:flex;
    background:linear-gradient(135deg,#eef2f7,#e3e9f2);
}

/* SIDEBAR */
.sidebar{
    width:260px;
    min-height:100vh;
    background:linear-gradient(180deg,#141e30,#243b55);
    color:white;
    padding:25px 20px;
    position:fixed;
}

.sidebar h3{
    text-align:center;
    margin-bottom:20px;
    font-weight:600;
}

.sidebar .profile{
    text-align:center;
    margin-bottom:30px;
}

.sidebar .profile img{
    width:80px;
    border-radius:50%;
    border:3px solid white;
    margin-bottom:10px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px;
    margin-bottom:8px;
    text-decoration:none;
    color:white;
    border-radius:8px;
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,0.15);
}

/* CONTENT */
.content{
    margin-left:260px;
    padding:40px;
    width:100%;
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.header h2{
    font-weight:600;
    color:#333;
}

/* STAT CARD */
.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:40px;
}

.stat-card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 25px rgba(0,0,0,0.05);
    display:flex;
    align-items:center;
    justify-content:space-between;
    transition:0.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-card i{
    font-size:30px;
    padding:18px;
    border-radius:50%;
    color:white;
}

.bg-red{background:#e74c3c;}
.bg-yellow{background:#f1c40f;}
.bg-blue{background:#3498db;}
.bg-green{background:#27ae60;}

/* SECTION CARD */
.section{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 25px rgba(0,0,0,0.05);
    margin-bottom:25px;
}

.section h4{
    margin-bottom:15px;
    font-weight:600;
}

/* BOOK CARD */
.book-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px;
    background:#f4f6fb;
    border-radius:10px;
}

.badge{
    background:#6c5ce7;
    color:white;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
}

/* BUTTON */
.btn-primary{
    display:inline-block;
    margin-top:15px;
    background:linear-gradient(135deg,#6c5ce7,#4834d4);
    color:white;
    padding:10px 20px;
    border-radius:25px;
    text-decoration:none;
    transition:0.3s;
}

.btn-primary:hover{
    opacity:0.9;
}

/* GRID BOTTOM */
.bottom{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}
</style>
</head>

<body>

<div class="sidebar">
    <h3>Perpustakaan</h3>

    <div class="profile">
        <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png">
        <p>Admin</p>
    </div>

    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Dashboard</a>
    <a href="{{ route('anggota.index') }}"><i class="fa fa-users"></i> Data Anggota</a>
    <a href="{{ route('buku.index') }}"><i class="fa fa-book"></i> Data Buku</a>
    <a href="#"><i class="fa fa-exchange-alt"></i> Transaksi</a>
    <a href="#"><i class="fa fa-user"></i> Data Admin</a>
</div>

<div class="content">

    <div class="header">
        <h2>Dashboard</h2>
        <div><i class="fa fa-user-circle"></i> Admin</div>
    </div>

    <!-- STATISTICS -->
    <div class="stats">
        <div class="stat-card">
            <div>
                <h3>1</h3>
                <small>Total Anggota</small>
            </div>
            <i class="fa fa-users bg-red"></i>
        </div>

        <div class="stat-card">
            <div>
                <h3>1</h3>
                <small>Total Buku</small>
            </div>
            <i class="fa fa-book bg-yellow"></i>
        </div>

        <div class="stat-card">
            <div>
                <h3>1</h3>
                <small>Total Transaksi</small>
            </div>
            <i class="fa fa-sync bg-blue"></i>
        </div>

        <div class="stat-card">
            <div>
                <h3>0</h3>
                <small>Total Pengunjung</small>
            </div>
            <i class="fa fa-user-friends bg-green"></i>
        </div>
    </div>

    <!-- DAFTAR BUKU -->
    <div class="section">
        <h4>Daftar Bacaan Perpustakaan</h4>

        <div class="book-item">
            <div>
                <i class="fa fa-book"></i>
                Atomic Habits
            </div>
            <span class="badge">2026/2/28</span>
        </div>

        <a href="{{ route('buku.index') }}" class="btn-primary">
            Lihat Buku
        </a>
    </div>

    <!-- BOTTOM -->
    <div class="bottom">

        <div class="section">
            <h4>Pemberitahuan</h4>
            <p>📌 Siswa telah terdaftar menjadi anggota</p>
            <p>📌 Admin baru berhasil ditambahkan</p>
            <p>📌 Buku baru tersedia di perpustakaan</p>
        </div>

        <div class="section">
            <h4>Anggota Baru</h4>
            <p><i class="fa fa-user"></i> Atomic Habits</p>
            <a href="{{ route('anggota.index') }}" class="btn-primary">
                Data Anggota
            </a>
        </div>

    </div>

</div>

</body>
</html>