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


Route::resource('transaksi', TransaksiController::class);
Route::get('transaksi/kembalikan/{id}', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');
Route::put('/transaksi/{id}/kembalikan', 
    [TransaksiController::class, 'kembalikan']
)->name('transaksi.kembalikan');
Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])
    ->name('transaksi.destroy');




Route::get('/login',[AuthController::class,'login']);
Route::post('/login',[AuthController::class,'authenticate']);
Route::get('/home',[PageController::class,'home'])->name('home');