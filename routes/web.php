<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ControllerAuth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DetailPeminjamanController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

// Route Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// --- PASTIKAN DUA BARIS INI ADA ---
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');


/*
|--------------------------------------------------------------------------
| WAJIB LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('ceklogin')->group(function () {

    Route::get('/home', [PageController::class, 'home'])->name('home');


    Route::resource('anggota', AnggotaController::class);
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');


    Route::resource('buku', BukuController::class);
    Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

    Route::get('/transaksi',[PeminjamanController::class,'index'])->name('peminjaman.index');
    Route::get('/transaksi/create',[PeminjamanController::class,'create'])->name('peminjaman.create');
    Route::post('/transaksi/store',[PeminjamanController::class,'store'])->name('peminjaman.store');

    Route::get('/transaksi/kembalikan/{id}',[PeminjamanController::class,'kembalikan'])->name('peminjaman.kembalikan');
    Route::get('/transaksi/hilang/{id}',[PeminjamanController::class,'hilang'])->name('peminjaman.hilang');
    Route::get('/transaksi/rusak/{id}',[PeminjamanController::class,'rusak'])->name('peminjaman.rusak');

    Route::post('/transaksi/kembalikan/{id}', [PeminjamanController::class,'prosesKembali'])->name('peminjaman.prosesKembali');
    Route::get('/transaksi/{id}/edit', [PeminjamanController::class,'edit'])->name('peminjaman.edit');
    Route::put('/transaksi/{id}', [PeminjamanController::class,'update'])->name('peminjaman.update');

    Route::put('/detail/{id}', [DetailPeminjamanController::class,'update'])->name('detail.update');
    Route::delete('/transaksi/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

    Route::get('/peminjaman/cetak', [PeminjamanController::class, 'cetak'])->name('peminjaman.cetak');

    // Cari baris ini di routes/web.php
// Ubah dari Route::get menjadi Route::post
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});