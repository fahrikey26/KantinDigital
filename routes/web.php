<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginCon;
use App\Http\Controllers\DashboardCon;
use App\Http\Controllers\RegisterCon;
use App\Http\Controllers\UserCon;
use App\Http\Controllers\KaryawanCon;
use App\Http\Controllers\KantinCon;
use App\Http\Controllers\MenuCon;
use App\Http\Controllers\TransaksiCon;
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

Route::get('/', [MenuCon::class, 'home'])->name('homeproduk');

Route::get('/login', [LoginCon::class, 'login'])->name('login');
Route::post('actionlogin', [LoginCon::class, 'actionlogin'])->name('actionlogin');
Route::get('dashboard', [DashboardCon::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('actionlogout', [LoginCon::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
Route::get('register', [RegisterCon::class, 'register'])->name('register');
Route::post('register/action', [RegisterCon::class, 'actionregister'])->name('actionregister');

Route::get('/user/tampil', [UserCon::class, 'tampil'])->name('indexUser')->middleware('auth');
Route::get('/user/input', [UserCon::class, 'input'])->name('inputUser')->middleware('auth');
Route::post('/user/storeinput', [UserCon::class, 'storeinput'])->name('storeInputUser')->middleware('auth');
Route::get('/user/update/{id}', [UserCon::class, 'update'])->name('updateUser')->middleware('auth');
Route::post('/user/storeupdate', [UserCon::class, 'storeupdate'])->name('storeUpdateUser')->middleware('auth');
Route::get('/user/delete/{id}', [UserCon::class, 'delete'])->name('deleteUser')->middleware('auth');

Route::get('/karyawan/tampil', [KaryawanCon::class, 'tampil'])->name('indexkaryawan')->middleware('auth');
Route::get('/karyawan/input', [KaryawanCon::class, 'input'])->name('inputkaryawan')->middleware('auth');
Route::post('/karyawan/storeinput', [KaryawanCon::class, 'storeinput'])->name('storeInputkaryawan')->middleware('auth');
Route::get('/karyawan/update/{id}', [KaryawanCon::class, 'update'])->name('updatekaryawan')->middleware('auth');
Route::post('/karyawan/storeupdate', [KaryawanCon::class, 'storeupdate'])->name('storeUpdatekaryawan')->middleware('auth');
Route::get('/karyawan/delete/{id}', [KaryawanCon::class, 'delete'])->name('deletekaryawan')->middleware('auth');

Route::get('/kantin/tampil', [KantinCon::class, 'tampil'])->name('indexKantin')->middleware('auth');
Route::get('/kantin/input', [KantinCon::class, 'input'])->name('inputKantin')->middleware('auth');
Route::post('/kantin/storeinput', [KantinCon::class, 'storeinput'])->name('storeInputKantin')->middleware('auth');
Route::get('/kantin/update/{id}', [KantinCon::class, 'update'])->name('updateKantin')->middleware('auth');
Route::post('/kantin/storeupdate', [KantinCon::class, 'storeupdate'])->name('storeUpdateKantin')->middleware('auth');
Route::get('/kantin/delete/{id}', [KantinCon::class, 'delete'])->name('deleteKantin')->middleware('auth');

Route::get('/menu/tampil', [MenuCon::class, 'tampil'])->name('indexMenu')->middleware('auth');
Route::get('/menu/input', [MenuCon::class, 'input'])->name('inputMenu')->middleware('auth');
Route::post('/menu/storeinput', [MenuCon::class, 'storeinput'])->name('storeInputMenu')->middleware('auth');
Route::get('/menu/update/{id}', [MenuCon::class, 'update'])->name('updateMenu')->middleware('auth');
Route::post('/menu/storeupdate', [MenuCon::class, 'storeupdate'])->name('storeUpdateMenu')->middleware('auth');
Route::get('/menu/delete/{id}', [MenuCon::class, 'delete'])->name('deleteMenu')->middleware('auth');

Route::get('/transaksi/tampil', [TransaksiCon::class, 'tampil'])->name('indexTransaksi')->middleware('auth');
Route::get('/transaksi/input', [TransaksiCon::class, 'input'])->name('inputTransaksi')->middleware('auth');
Route::post('/transaksi/storeinput', [TransaksiCon::class, 'storeinput'])->name('storeInputTransaksi')->middleware('auth');
Route::get('/transaksi/update/{id}', [TransaksiCon::class, 'update'])->name('updateTransaksi')->middleware('auth');
Route::post('/transaksi/storeupdate', [TransaksiCon::class, 'storeupdate'])->name('storeUpdateTransaksi')->middleware('auth');
Route::get('/transaksi/delete/{id}', [TransaksiCon::class, 'delete'])->name('deleteTransaksi')->middleware('auth');
