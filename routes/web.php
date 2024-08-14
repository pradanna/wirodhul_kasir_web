<?php

use App\Http\Controllers\Kasir\TambahMenuController;
use App\Http\Controllers\Kasir\KasirController;
use App\Http\Controllers\Kasir\LaporanPemasukanController;
use App\Http\Controllers\Kasir\LaporanPengeluaranController;
use App\Http\Controllers\Kasir\MembersController;
use App\Http\Controllers\Kasir\PengeluaranController;
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

Route::get('/', function () {
    return view('auth.login');
});


Route::match(['GET', 'POST'], '/login', [\App\Http\Controllers\Admin\LoginController::class, 'index'])->name('login');
Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout']);


Route::prefix('/admin')->middleware('auth')->group(function () {});

Route::prefix('kasir')->group(function () {
    Route::get('/', [KasirController::class, 'index'])->name('kasir.dashboard');
    Route::get('/tambahmenu', [TambahMenuController::class, 'index'])->name('kasir.tambahmenu');
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('kasir.pengeluaran');
    Route::get('/laporanpemasukan', [LaporanPemasukanController::class, 'index'])->name('kasir.laporanpemasukan');
    Route::get('/laporanpengeluaran', [LaporanPengeluaranController::class, 'index'])->name('kasir.laporanpengeluaran');
    Route::get('/cetak-nota', [KasirController::class, 'cetakNota'])->name('kasir.cetaknota');
    Route::get('/cetak-laporan-pemasukan', [LaporanPemasukanController::class, 'cetakLaporanPemasukan'])->name('kasir.cetaklaporanpemasukan');
    Route::get('/cetak-laporan-pengeluaran', [LaporanPengeluaranController::class, 'cetakLaporanPengeluaran'])->name('kasir.cetaklaporanpengeluaran');
    Route::get('/members', [MembersController::class, 'index'])->name('kasir.members');
});
