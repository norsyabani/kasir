<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PendapatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::Group(['middleware' => ['auth']], function () {
    Route::get('/', [MainController::class, 'index']);
    Route::resource('/produk', ProdukController::class, ['except' => ['show', 'create', 'edit']]);
    Route::resource('/kategori', KategoriController::class, ['except' => ['show', 'create', 'edit']]);
    Route::resource('/transaksi', TransaksiController::class);
    Route::post('/transaksi', [TransaksiController::class, 'add'])->name('transaksi.add');
    Route::get('/transaksi/{id}/detail', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::get('/transaksi/{id}/get_order', [TransaksiController::class, 'getOrder'])->name('transaksi.getOrder');
    Route::post('/transaksi/{id}/add_item', [TransaksiController::class, 'addItem'])->name('transaksi.addItem');
    Route::get('/transaksi/{id}/get_order_detail', [TransaksiController::class, 'getOrderDetail'])->name('transaksi.getOrderDetail');
    Route::post('/transaksi/{id}/delete_item', [TransaksiController::class, 'deleteItem'])->name('transaksi.deleteItem');
    Route::post('/transaksi/{id}/checkout', [TransaksiController::class, 'checkout'])->name('transaksi.checkout');
    Route::resource('/pendapatan', PendapatanController::class, ['except' => ['show', 'create', 'edit']]);
    Route::get('/pendapatan/get_data', [PendapatanController::class, 'getData'])->name('pendapatan.getData');
    Route::get('/pendapatan/{param}/{date}/detail', [PendapatanController::class, 'detail'])->name('pendapatan.detail');
    Route::get('/pendapatan/{param}/sort', [PendapatanController::class, 'sort'])->name('pendapatan.sort');
});
