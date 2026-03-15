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
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home', [PageController::class, 'home'])->name('home');


Route::resource('anggota', AnggotaController::class);
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');


Route::resource('buku', BukuController::class);
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');


Route::get('/transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
Route::get('/transaksi/create',[TransaksiController::class,'create'])->name('transaksi.create');
Route::post('/transaksi/store',[TransaksiController::class,'store'])->name('transaksi.store');

Route::get('/transaksi/kembalikan/{id}',[TransaksiController::class,'kembalikan'])->name('transaksi.kembalikan');
Route::get('/transaksi/hilang/{id}',[TransaksiController::class,'hilang'])->name('transaksi.hilang');
Route::get('/transaksi/rusak/{id}',[TransaksiController::class,'rusak'])->name('transaksi.rusak');

Route::get('/transaksi/kembalikan/{id}', [TransaksiController::class,'kembalikan'])->name('transaksi.kembalikan');
Route::post('/transaksi/kembalikan/{id}', [TransaksiController::class,'prosesKembali'])->name('transaksi.prosesKembali');
Route::get('/transaksi/{id}/edit', [TransaksiController::class,'edit'])->name('transaksi.edit');
Route::put('/transaksi/{id}', [TransaksiController::class,'update'])->name('transaksi.update');
Route::put('/detail/{id}', [DetailTransaksiController::class,'update'])->name('detail.update');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');