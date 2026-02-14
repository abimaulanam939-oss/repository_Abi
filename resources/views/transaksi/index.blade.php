<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaksi Perpustakaan</title>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
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
}

/* PROFILE */
.profile{
    text-align:center;
    margin-bottom:30px;
}

.profile img{
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

.submenu{
    display:none;
    margin-left:20px;
}

/* CONTENT */
.content{
    margin-left:260px;
    padding:40px;
    width:100%;
}

.section{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 8px 25px rgba(0,0,0,0.05);
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:12px;
    border-bottom:1px solid #eee;
}

th{
    background:#f4f6fb;
    text-align:left;
}

.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    color:white;
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

    <a href="{{ route('home') }}">
        <i class="fa fa-home"></i> Dashboard
    </a>

    <a href="{{ route('anggota.index') }}">
        <i class="fa fa-users"></i> Data Anggota
    </a>

    <a href="{{ route('buku.index') }}">
        <i class="fa fa-book"></i> Data Buku
    </a>

    <!-- TOGGLE TRANSAKSI -->
    <a href="javascript:void(0)" onclick="toggleMenu()">
        <i class="fa fa-exchange-alt"></i> Transaksi
        <i class="fa fa-chevron-down" style="margin-left:auto;"></i>
    </a>

    <div class="submenu" id="submenu">
        <a href="{{ route('transaksi.peminjaman') }}">
            <i class="fa fa-arrow-right"></i> Peminjaman
        </a>

        <a href="{{ route('transaksi.pengembalian') }}">
            <i class="fa fa-undo"></i> Pengembalian
        </a>
    </div>
</div>

<div class="content">

    <div class="section">
        <h3 style="margin-bottom:20px;">Data Transaksi</h3>

        <table>
            <tr>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>

            @foreach($transaksis as $t)
            <tr>
                <td>{{ $t->anggota->nama }}</td>
                <td>{{ $t->buku->judul }}</td>
                <td>{{ $t->tanggal_pinjam }}</td>
                <td>
                    @if($t->status == 'dipinjam')
                        <span class="badge" style="background:#e74c3c;">
                            Dipinjam
                        </span>
                    @else
                        <span class="badge" style="background:#27ae60;">
                            Dikembalikan
                        </span>
                    @endif
                </td>
            </tr>
            @endforeach

        </table>
    </div>

</div>

<script>
function toggleMenu(){
    var menu = document.getElementById("submenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>