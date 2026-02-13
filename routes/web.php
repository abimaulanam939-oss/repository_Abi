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
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/keg', function () {
//     return view('kegiatan');
// });

// Route::get('/ind', function () {
//     return view('index');
// });

// Route::get('/cont', function () {
//     return view('contact');
// });

// Route::get('/cont/srv', function () {
//     return view('conn');
// });


// Route::get('/pres', function () {
//     return view('prestasi');
// });


// Route::get('/log', function () {
//     return view('login');
// });

// Route::get('/prof', function () {
//     return view('profil');

// Route::get('/kegiatan',[KegiatanController::class,'Kegiatan']);

// Route::get('/Prestasi',[ContactController::class,'Prestasi']);

// Route::get('/Profil',[ContactController::class,'Profil']);

// Route::get('/User',[UserController::class,'tambahdata']);

// Route::get('/orders',[OrdersController::class,'index'])->name('Orders');

// Route::get('/customer',[CustomerController::class,'index'])->name('Customer');

// Route::get('/products',[ProductController::class,'index'])->name('Products');

// Route::get('/Index',[ContactController::class,'Index']);

// Route::post('contact',[ContactController::class,'store'])->name('contact.store');

// Route::get('/login',[ControllerAuth::class,'Index'])->name('index');

// Route::post('cek_user',[ControllerAuth::class,'cek_akun'])->name('cek_user');

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Route::get('/buku', [BukuController::class, 'buku'])->name('buku.index');

Route::get('/home', [PageController::class, 'home'])->name('home');

Route::resource('anggota', AnggotaController::class);
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');


Route::resource('buku', BukuController::class);


