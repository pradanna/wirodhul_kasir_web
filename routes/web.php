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

    Route::group(['prefix' => 'pengguna'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user');
        Route::match(['post', 'get'], '/tambah', [\App\Http\Controllers\Admin\UserController::class, 'add'])->name('admin.user.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user.delete');
    });

    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('admin.category');
        Route::match(['post', 'get'], '/tambah', [\App\Http\Controllers\Admin\CategoriesController::class, 'add'])->name('admin.category.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\CategoriesController::class, 'edit'])->name('admin.category.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\CategoriesController::class, 'delete'])->name('admin.category.delete');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\MenuController::class, 'index'])->name('admin.menu');
        Route::match(['post', 'get'], '/tambah', [\App\Http\Controllers\Admin\MenuController::class, 'add'])->name('admin.menu.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\MenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('admin.menu.delete');
    });

    Route::group(['prefix' => 'setting-diskon'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\DiscountSettingController::class, 'index'])->name('admin.discount');
        Route::match(['post', 'get'], '/tambah', [\App\Http\Controllers\Admin\DiscountSettingController::class, 'add'])->name('admin.discount.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\DiscountSettingController::class, 'edit'])->name('admin.discount.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\DiscountSettingController::class, 'delete'])->name('admin.discount.delete');
    });

    Route::group(['prefix' => 'penjualan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('admin.transaction');
    });
});

Route::prefix('kasir')->group(function () {
    Route::match(['post', 'get'], '/', [\App\Http\Controllers\Cashier\DashboardController::class, 'index'])->name('cashier.dashboard');
    Route::match(['post', 'get'], '/cart', [\App\Http\Controllers\Cashier\DashboardController::class, 'addToCart'])->name('cashier.dashboard.add.cart');
    Route::match(['post', 'get'], '/cart/discount', [\App\Http\Controllers\Cashier\DashboardController::class, 'get_discount'])->name('cashier.dashboard.discount');
    Route::match(['post', 'get'], '/cart/checkout', [\App\Http\Controllers\Cashier\DashboardController::class, 'checkout'])->name('cashier.dashboard.checkout');

    Route::group(['prefix' => 'member'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('cashier.member');
        Route::match(['post', 'get'], '/tambah', [\App\Http\Controllers\Admin\MemberController::class, 'add'])->name('cashier.member.add');
        Route::match(['post', 'get'], '/{id}/edit', [\App\Http\Controllers\Admin\MemberController::class, 'edit'])->name('cashier.member.edit');
        Route::post('/{id}/delete', [\App\Http\Controllers\Admin\MemberController::class, 'delete'])->name('cashier.member.delete');
    });

    Route::group(['prefix' => 'penjualan'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('cashier.transaction');
    });
//    Route::get('/', [KasirController::class, 'index'])->name('kasir.dashboard');
//    Route::get('/tambahmenu', [TambahMenuController::class, 'index'])->name('kasir.tambahmenu');
//    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('kasir.pengeluaran');
//    Route::get('/laporanpemasukan', [LaporanPemasukanController::class, 'index'])->name('kasir.laporanpemasukan');
//    Route::get('/laporanpengeluaran', [LaporanPengeluaranController::class, 'index'])->name('kasir.laporanpengeluaran');
//    Route::get('/cetak-nota', [KasirController::class, 'cetakNota'])->name('kasir.cetaknota');
//    Route::get('/cetak-laporan-pemasukan', [LaporanPemasukanController::class, 'cetakLaporanPemasukan'])->name('kasir.cetaklaporanpemasukan');
//    Route::get('/cetak-laporan-pengeluaran', [LaporanPengeluaranController::class, 'cetakLaporanPengeluaran'])->name('kasir.cetaklaporanpengeluaran');
//    Route::get('/members', [MembersController::class, 'index'])->name('kasir.members');
});
