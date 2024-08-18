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

Route::match(['post', 'get'], '/', [\App\Http\Controllers\Admin\LoginController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\Admin\LoginController::class, 'logout']);


Route::prefix('/admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::group(['prefix' => 'pengguna'], function (){
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user');
        Route::match(['post', 'get'],'/tambah', [\App\Http\Controllers\Admin\UserController::class, 'add'])->name('admin.user.add');
        Route::match(['post', 'get'],'/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user.delete');
    });

    Route::group(['prefix' => 'kategori'], function (){
        Route::get('/', [\App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('admin.category');
        Route::match(['post', 'get'],'/tambah', [\App\Http\Controllers\Admin\CategoriesController::class, 'add'])->name('admin.category.add');
        Route::match(['post', 'get'],'/{id}/edit', [\App\Http\Controllers\Admin\CategoriesController::class, 'edit'])->name('admin.category.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\CategoriesController::class, 'delete'])->name('admin.category.delete');
    });
});

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
