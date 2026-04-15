<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; margin: 0; }
        
        /* Header / Kop Surat Styles */
        .kop-surat { 
            width: 100%; 
            margin-bottom: 20px; 
            border-bottom: 3px double #000; /* Garis ganda khas kop surat */
            padding-bottom: 10px; 
        }
        .kop-table { 
            width: 100%; 
            border: none !important; 
        }
        .kop-table td { 
            border: none !important; 
            vertical-align: middle; 
        }
        .logo-img { 
            width: 70px; /* Sesuaikan ukuran logo */
        }
        .judul-kop {
            text-align: center;
        }

        /* Table Data Styles */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #f2f2f2; border: 1px solid #000; padding: 10px; text-transform: uppercase; }
        td { border: 1px solid #000; padding: 8px; vertical-align: top; }
        
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
        .text-right { text-align: right; }
        
        /* Warna khusus untuk kondisi */
        .status-rusak { color: #e67e22; font-weight: bold; }
        .status-hilang { color: #e74c3c; font-weight: bold; }
        .status-aman { color: #27ae60; }
    </style>
</head>
<body>
<div class="kop-surat">
    <table class="kop-table">
        <tr>
            
            <td width="70%" class="judul-kop">
                <h1 style="margin: 0; font-size: 16px;">LAPORAN PEMINJAMAN PERPUSTAKAAN</h1>
                <h2 style="margin: 5px 0; font-size: 14px;">SMK BINA PUTRA MANDIRI</h2>
                <p style="margin: 0; font-size: 10px;">Jl. Raya Parung Panjang No. 01, Kec. Parung Panjang, Kab. Bogor</p>
            </td>

        </tr>
    </table>
</div>

    <table>
        <thead>
            <tr>
                <th width="20">No</th>
                <th>Nama Siswa (NIPD)</th>
                <th>Kelas & Jurusan</th>
                <th>Buku, No Seri & Kondisi</th> 
                <th width="60">Pinjam</th>
                <th width="60">Kembali</th>
                <th width="60">Status</th>
                <th width="80">Denda</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $key => $t)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                <td>
                    <span class="text-bold">{{ $t->anggota->nama ?? '-' }}</span><br>
                    <small>NIPD: {{ $t->anggota->nipd ?? '-' }}</small>
                </td>
                
                <td class="text-center">
                    {{ $t->anggota->kelas ?? '-' }}<br>
                    <span class="text-bold">{{ $t->anggota->jurusan ?? '-' }}</span>
                </td>

                <td>
                    @foreach($t->detail as $d)
                        <div style="margin-bottom: 5px; border-bottom: 1px dotted #ccc; padding-bottom: 2px;">
                            • {{ $d->buku->judul ?? '-' }} <br>
                            <small>
                                SN: <strong>{{ $d->no_seri }}</strong> | 
                                Kondisi: 
                                @if($d->kondisi == 'rusak')
                                    <span class="status-rusak">Rusak</span>
                                @elseif($d->kondisi == 'hilang')
                                    <span class="status-hilang">Hilang</span>
                                @else
                                    <span class="status-aman">Baik</span>
                                @endif
                            </small>
                        </div>
                    @endforeach
                </td>
                <td class="text-center">{{ date('d/m/Y', strtotime($t->tanggal_pinjam)) }}</td>
                <td class="text-center">{{ date('d/m/Y', strtotime($t->tanggal_kembali)) }}</td>
                <td class="text-center">
                    <span class="text-bold">{{ ucfirst($t->status) }}</span>
                </td>
                <td class="text-right">
                    <span class="text-bold">Rp {{ number_format($t->denda, 0, ',', '.') }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; float: right; width: 200px; text-align: center;">
        <p>Bogor, {{ date('d F Y') }}</p>
        <p>Petugas Perpustakaan,</p>
        <br><br><br>
        <p><strong>( ____________________ )</strong></p>
    </div>

</body>
</html>