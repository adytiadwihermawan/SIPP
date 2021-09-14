<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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

Route::get('datauser', [AdminController::class, 'datauser'])->name('search');

Route::post('adduser', [AdminController::class, 'adduser'])->name('tambahpengguna');

Route::get('datakelas', [AdminController::class, 'datakelas']);

Route::post('addkelas', [AdminController::class, 'addkelas']);

Route::post('addpeserta', [AdminController::class, 'addpeserta']);

Route::post('addasisten', [AdminController::class, 'addasisten']);

Route::get('datalab', [AdminController::class, 'datalab']);

Route::post('addlab', [AdminController::class, 'addlab']);

Route::view('/tambahuser', 'admin.tambahuser');

Route::view('/tambahkelas', 'admin.tambahkelas');

Route::get('/tambahpeserta', [AdminController::class, 'pesertakelas']);

Route::get('/tambahasisten', [AdminController::class, 'asistenkelas']);

Route::get('/tambahlab', [AdminController::class, 'lab']);

Route::get('edit/{id}', [AdminController::class, 'edit']);

Route::post('update', [AdminController::class, 'update'])->name('update');

Route::get('delete/{id}', [AdminController::class, 'delete']);

Route::get('editkelas/{id}', [AdminController::class, 'editkelas']);

Route::post('updatekelas', [AdminController::class, 'updatekelas']);

Route::get('deletekelas/{id}', [AdminController::class, 'deletekelas']);

Route::get('editlab/{id}', [AdminController::class, 'editlab']);

Route::post('updatelab', [AdminController::class, 'updatelab']);

Route::get('deletelab/{id}', [AdminController::class, 'deletelab']);

Route::view('/openrekrutasist', 'admin.bukapendaftaran');

// ----------------------------------------- Dashboard Dosen -------------------------------------------------------------------- \\

Route::get('dosen/dashboard', [UserController::class, 'dashboardDsn'])->name('dsn.dashboard')->middleware('dsnMid');

Route::get('dosen/profile', [UserController::class, 'dsnProfile']);

Route::get('dosen/presensi', [UserController::class, 'dsnPresensi']);

Route::post('change-profile-pic', [UserController::class, 'updateFoto'])->name('updateFotoUser');

Route::post('change-password', [UserController::class, 'gantiPassword'])->name('gantiPassword');

Route::get('dsn/matkul/{id}', [UserController::class, 'matkulDsn'])->name('matkulDsn');

Route::post('upload', [UserController::class, 'upload'])->name('fileUpload');

Route::get('downloadfile{file}', [UserController::class, 'downloadFile'])->name('download');

Route::post('pertemuan', [UserController::class, 'buatPertemuan'])->name('pertemuan');

Route::post('absen', [UserController::class, 'buatAbsen'])->name('absen');

Route::get('dsn/partisipan/{id}', [UserController::class, 'dataTable'])->name('data');

// ----------------------------------------- Dashboard Asisten -------------------------------------------------------------------- \\

Route::get('asist/home', [UserController::class, 'asistDashboard'])->name('asist.dashboard')->middleware('asistMid');

Route::get('asist/dashboard', [UserController::class, 'asistHome'])->name('asist.home');

Route::get('asist/matkul/{id}', [UserController::class, 'matkulAsisten']);


// -----------------------------------------  Dashboard Mahasiswa -------------------------------------------------------------------- \\

Route::get('mhs/home', [UserController::class, 'dashboardMhs'])->name('mhs.dashboard')->middleware('mhsMid');

Route::get('mhs/dashboard', [App\Http\Controllers\HomeController::class, 'mhsHome'])->name('mhs.home');

Route::get('mhs/profile', [UserController::class, 'mhsProfile']);

Route::get('mhs/presensi', [UserController::class, 'mhsPresensi']);

Route::get('mhs/matkul/{id}', [UserController::class, 'matkulMhs']);

Route::view('form-daftar-asisten', [UserController::class, 'formdaftar']);

Route::post('change-profile-pic', [UserController::class, 'updateFoto'])->name('updateFotoUser');

Route::post('change-password', [UserController::class, 'gantiPassword'])->name('gantiPassword');
