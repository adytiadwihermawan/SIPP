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
Route::get('admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard')->middleware('adminMid');

Route::get('datauser', [AdminController::class, 'datauser']);

Route::post('adduser', [AdminController::class, 'adduser'])->name('tambahpengguna');

Route::get('datakelas', [AdminController::class, 'datakelas']);

Route::post('addkelas', [AdminController::class, 'addkelas']);

Route::post('/addpeserta', [AdminController::class, 'addpeserta']);

Route::post('delete-peserta', [AdminController::class, 'deletepeserta']);

Route::post('/addasisten', [AdminController::class, 'addasisten']);

Route::post('delete-asisten', [AdminController::class, 'deleteasisten']);

Route::get('datalab', [AdminController::class, 'datalab']);

Route::post('addlab', [AdminController::class, 'addlab']);

Route::get('/tambahuser', [AdminController::class, 'tambahuser']);

Route::get('/tambahkelas', [AdminController::class, 'tambahkelas']);

Route::get('tambahpeserta/{id}', [AdminController::class, 'pesertakelas']);

Route::get('tambahasisten/{id}', [AdminController::class, 'asistenkelas']);

Route::get('/tambahlab', [AdminController::class, 'lab']);

Route::get('/edituser/{id}', [AdminController::class, 'edit']);

Route::post('update', [AdminController::class, 'update']);

Route::post('/delete-user', [AdminController::class, 'deleteuser'])->name('hapus');

Route::get('editkelas/{id}', [AdminController::class, 'editkelas']);

Route::post('updatekelas', [AdminController::class, 'updatekelas']);

Route::post('deletekelas', [AdminController::class, 'deletekelas']);

Route::get('editlab/{id}', [AdminController::class, 'editlab']);

Route::post('updatelab', [AdminController::class, 'updatelab']);

Route::post('/deletelab', [AdminController::class, 'deletelab']);

Route::get('openrekrutasist', [AdminController::class, 'openpendaftaran']);

Route::post('file-import', [AdminController::class, 'fileImport'])->name('file-import');

Route::post('file-import-peserta', [AdminController::class, 'fileImportPeserta'])->name('file-import-peserta');

Route::post('tambah-mk', [AdminController::class, 'tambahMK']);

Route::post('delete-mk', [AdminController::class, 'hapus']);

Route::post('status-form', [AdminController::class, 'updateform']);

Route::get('daftarcalonasisten', [AdminController::class, 'viewcalon']);

Route::get('rekapasisten', [AdminController::class, 'rekapasisten']);

Route::get('sertifikat-asisten', [AdminController::class, 'sertifikat']);


// ----------------------------------------- Dashboard Dosen -------------------------------------------------------------------- \\

Route::get('dosen/dashboard', [UserController::class, 'dashboardDsn'])->name('dsn.dashboard')->middleware('dsnMid');

Route::get('dosen/profile', [UserController::class, 'dsnProfile']);

Route::get('dosen/presensi', [UserController::class, 'dsnPresensi']);

Route::post('change-profile-pic', [UserController::class, 'updateFoto'])->name('updateFotoUser');

Route::post('change-password', [UserController::class, 'gantiPassword'])->name('gantiPassword');

Route::get('dsn/matkul/{id}', [UserController::class, 'matkulDsn'])->name('matkulDsn');

Route::post('upload', [UserController::class, 'upload'])->name('fileUpload');

Route::post('uploadtugas', [UserController::class, 'uploadTugas'])->name('uploadTugas');

Route::post('updatetugas', [UserController::class, 'updateTugas'])->name('updateTugas');

Route::get('edittugas', [UserController::class, 'edittugas']);

Route::get('deletemateri/{id}', [UserController::class, 'deletemateri']);

Route::get('deletetugas/{id}', [UserController::class, 'deletetugas']);

Route::get('deleteabsen/{id}', [UserController::class, 'deleteabsen']);

Route::get('downloadfile{file}', [UserController::class, 'downloadFile'])->name('download');

Route::post('pertemuan', [UserController::class, 'buatPertemuan'])->name('pertemuan');

Route::get('edit', [UserController::class, 'editpertemuan']);

Route::post('editpertemuan', [UserController::class, 'updatePertemuan'])->name('updatepertemuan');

Route::post('absen', [UserController::class, 'buatAbsen'])->name('buatAbsen');

Route::get('editabsen', [UserController::class, 'editabsen']);

Route::get('dsn/rekap/{id_praktikum}/{id}', [UserController::class, 'viewrekap'])->name('rekap');

Route::post('editpresensi', [UserController::class, 'updateAbsen'])->name('updateAbsen');

Route::get('grade', [UserController::class, 'getNilai']);

Route::post('nilai', [UserController::class, 'nilai'])->name('nilaiTugas');

Route::get('dsn/partisipan/{id}', [UserController::class, 'dsnPartisipan'])->name('data');

Route::get('dsn/grade/{id}', [UserController::class, 'dsnGrade'])->name('grade');

Route::get('dsn/presensi/{id}', [UserController::class, 'rekapAbsen'])->name('absen');

Route::get('file-export', [UserController::class, 'fileExport'])->name('file-export');

Route::get('export-rekap{id}', [UserController::class, 'exportRekap'])->name('exportrekap');

// ----------------------------------------- Dashboard Asisten -------------------------------------------------------------------- \\

Route::get('asist/home', [UserController::class, 'asistDashboard'])->name('asist.dashboard')->middleware('asistMid');

Route::get('asist/dashboard', [UserController::class, 'asistHome'])->name('asist.home');

Route::get('asist/matkul/{id}', [UserController::class, 'matkulAsisten'])->name('matkulAsisten');

Route::get('asist/partisipan/{id}', [UserController::class, 'asistPartisipan'])->name('asistenPart');

Route::get('asist/grade/{id}', [UserController::class, 'asistGrade'])->name('gradeAsisten');

Route::get('asist/presensi/{id}', [UserController::class, 'rekapAsisten'])->name('asistenRekap');

Route::get('asist/rekap/{id_praktikum}/{id}', [UserController::class, 'viewrekapasisten'])->name('dataPresensiAsisten');

// -----------------------------------------  Dashboard Mahasiswa -------------------------------------------------------------------- \\

Route::get('dashboard', [UserController::class, 'dashboardMhs'])->name('mhs.dashboard')->middleware('mhsMid');

Route::get('profile', [UserController::class, 'mhsProfile']);

Route::get('presensi/{id}', [UserController::class, 'dataAbsen'])->name('presensi');

Route::get('matkul/{id}', [UserController::class, 'matkulMhs'])->name('mhsMatkul');

Route::get('mhs/partisipan/{id}', [UserController::class, 'partisipan'])->name('partisipan');

Route::get('matkul/{id_praktikum}/tugas/{id_pertemuan}/{id}', [UserController::class, 'tampilTugas'])->name('tugas');

Route::post('send-assignment', [UserController::class, 'kumpulTugas'])->name('assignment');

Route::post('signaturepad', [UserController::class, 'signature'])->name('signature');

Route::get('deletesubmission/{id}', [UserController::class, 'deletesubmission']);

Route::get('formdaftarasisten', [UserController::class, 'formasisten'])->name('form');

Route::post('daftarAsisten', [UserController::class, 'daftar'])->name('daftarAsisten');