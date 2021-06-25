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

Route::post('addpeserta', [AdminController::class, 'addpeserta']);

Route::get('datalab', [AdminController::class, 'datalab']);

Route::post('addlab', [AdminController::class, 'addlab']);

Route::view('/tambahuser', 'admin.tambahuser');

Route::view('/tambahkelas', 'admin.tambahkelas');

Route::get('edit/{id}', [AdminController::class, 'edit']);

Route::post('update', [AdminController::class, 'update']);

Route::get('delete/{id}', [AdminController::class, 'delete']);

Route::get('editkelas/{id}', [AdminController::class, 'editkelas']);

Route::post('updatekelas', [AdminController::class, 'updatekelas']);

Route::get('deletekelas/{id}', [AdminController::class, 'deletekelas']);

Route::get('editlab/{id}', [AdminController::class, 'editlab']);

Route::post('updatelab', [AdminController::class, 'updatelab']);

Route::get('deletelab/{id}', [AdminController::class, 'deletelab']);

// ----------------------------------------- Dashboard Dosen -------------------------------------------------------------------- \\

Route::get('dosen/dashboard', [App\Http\Controllers\UserController::class, 'dashboardDsn'])->name('dsn.dashboard')->middleware('dsnMid');

Route::view('dosen/profile', 'dsn.profile');

Route::view('dosen/presensi', 'dsn.presensi');

// ----------------------------------------- Dashboard Asisten -------------------------------------------------------------------- \\

Route::get('asist/dashboard', [App\Http\Controllers\HomeController::class, 'asistDashboard'])->name('asist.dashboard')->middleware('asistMid');

Route::view('asist/presensi', 'asist.presensi');

// -----------------------------------------  Dashboard Mahasiswa -------------------------------------------------------------------- \\

Route::get('mhs/dashboard', [App\Http\Controllers\UserController::class, 'dashboardMhs'])->name('mhs.dashboard')->middleware('mhsMid');

Route::view('mhs/profile', 'mhs.profile');

Route::view('mhs/presensi', 'mhs.presensi');

Route::view('form-daftar-asisten', 'formdftrasisten');

Route::post('change-profile-pic', [App\Http\Controllers\UserController::class, 'updateFoto'])->name('updateFotoUser');

Route::post('change-password', [\App\Http\Controllers\UserController::class, 'gantiPassword'])->name('gantiPassword');
