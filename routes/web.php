<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ----------------------------------------- Admin Dashboard -------------------------------------------------------------------- \\
Route::get('admin/dashboard', [App\Http\Controllers\HomeController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('adminMid');

Route::get('datauser', [AdminController::class, 'datauser']);

Route::post('adduser', [AdminController::class, 'adduser']);

Route::get('datakelas', [AdminController::class, 'datakelas']);

Route::post('addkelas', [AdminController::class, 'addkelas']);

Route::get('peserta/{id}', [AdminController::class, 'peserta']);

Route::post('addpeserta', [AdminController::class, 'addpeserta']);

Route::get('datalab', [AdminController::class, 'datalab']);

Route::post('addlab', [AdminController::class, 'addlab']);

Route::view('/tambahuser', 'admin.tambahuser');

Route::view('/tambahkelas', 'admin.tambahkelas');

Route::view('/tambahpeserta', 'admin.addpeserta');

Route::get('edit/{id}', [AdminController::class, 'edit']);

// Route::post('update', [AdminController::class, 'update']);

Route::get('delete/{id}', [AdminController::class, 'delete']);
// ----------------------------------------- Dashboard Dosen -------------------------------------------------------------------- \\

Route::get('dosen/dashboard', [App\Http\Controllers\HomeController::class, 'dsnDashboard'])->name('dsn.dashboard')->middleware('dsnMid');

Route::view('dosen/profile', 'dsn.profile');

Route::view('dosen/presensi', 'dsn.presensi');

// ----------------------------------------- Dashboard Asisten -------------------------------------------------------------------- \\

Route::get('asist/dashboard', [App\Http\Controllers\HomeController::class, 'asistDashboard'])->name('asist.dashboard')->middleware('asistMid');

Route::view('asist/presensi', 'asist.presensi');

// -----------------------------------------  Dashboard Mahasiswa -------------------------------------------------------------------- \\

Route::get('mhs/dashboard', [App\Http\Controllers\HomeController::class, 'mhsDashboard'])->name('mhs.dashboard')->middleware('mhsMid');

Route::view('mhs/profile', 'mhs.profile');

Route::view('mhs/presensi', 'mhs.presensi');

Route::view('form-daftar-asisten', 'formdftrasisten');
