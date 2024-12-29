<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardSuperAdmin;
use App\Http\Controllers\DashboardUser;
use App\Http\Controllers\ExportDataController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RantingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegesahanController;
use App\Http\Controllers\PendidikanTerakhirController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\RiwayatPelatihanController;
use App\Http\Controllers\SertifikasiController;
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

Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/super-admin-login', [LoginController::class, 'handleLoginSuperAdmin']);
Route::post('/admin-login', [LoginController::class, 'handleLoginAdmin']);
Route::post('/', [LoginController::class, 'handleLoginUser']);


Route::middleware(['auth.TelahLogin'])->group(function () {
    Route::get('/super-admin-login', [LoginController::class, 'superAdminloginPage']);

    Route::get('/admin-login', [LoginController::class, 'adminloginPage']);

    Route::get('/', [LoginController::class, 'userloginPage']);
});

Route::middleware(['auth.superAdmin'])->group(function () {
    Route::prefix('super-admin')->group(function () {
        Route::get('/dashboard', [DashboardSuperAdmin::class, 'dashboardSuperAdmin']);
        Route::get('/list-ranting', [DashboardSuperAdmin::class, 'listRantingPage']);
        Route::get('/list-admin', [DashboardSuperAdmin::class, 'listAdminPage']);
        Route::get('/export-warga', [ExportDataController::class, 'exportBySuperAdmin']);
    });
});



Route::middleware(['auth.Admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboardAdmin']);
        Route::get('/export-warga', [ExportDataController::class, 'exportByAdmin']);
    });
});


Route::middleware(['auth.User'])->group(function () {
    Route::get('/user-konfigurasi', [ProfileController::class, 'firstTimeLogin']);
    Route::post('/user-konfigurasi', [UserController::class, 'updateByUser']);

    Route::get('/kelengkapan-biodata', [ProfileController::class, 'kelengkapanBiodata']);
    Route::post('/kelengkapan-biodata', [ProfileController::class, 'addOrUpdateBiodata']);

    Route::get('/dashboard', [DashboardUser::class, 'dashboardUserView']);
    Route::get('/dashboard/edit-biodata', [ProfileController::class, 'editBiodataUser']);
    Route::post('/dashboard/edit-biodata', [ProfileController::class, 'addOrUpdateBiodata']);

    Route::get('/kartu-warga/{id}', [ProfileController::class, 'getKartuWarga']);
    Route::get('/ktp-warga/{id}', [ProfileController::class, 'getKTP']);

    Route::get('/dashboard/data-pengesahan', [PegesahanController::class, 'dataPengesahan']);
    Route::post('/dashboard/data-pengesahan', [PegesahanController::class, 'create']);
    Route::get('/delete-data-pengesahan/{id}', [PegesahanController::class, 'delete']);
    Route::get('/sertifikat-pengesahan/{id}', [PegesahanController::class, 'getSertifikatPengesahan']);

    Route::get('/dashboard/data-riwayat-pelatihan', [RiwayatPelatihanController::class, 'getRiwayatPelatihan']);
    Route::post('/dashboard/data-riwayat-pelatihan', [RiwayatPelatihanController::class, 'create']);
    Route::get('/sertifikat-pelatihan/{id}', [RiwayatPelatihanController::class, 'getSertifikat']);
    Route::get('/delete-sertifikat-pelatihan/{id}', [RiwayatPelatihanController::class, 'delete']);

    Route::get('/dashboard/data-jabatan', [JabatanController::class, 'getJabatan']);
    Route::post('/dashboard/data-jabatan', [JabatanController::class, 'create']);
    Route::get('/sk-jabatan/{id}', [JabatanController::class, 'getSKJabatan']);
    Route::get('/delete-data-jabatan/{id}', [JabatanController::class, 'delete']);

    Route::get('/dashboard/riwayat-sertifikasi', [SertifikasiController::class, 'getSertifikasi']);
    Route::post('/dashboard/riwayat-sertifikasi', [SertifikasiController::class, 'create']);
    Route::get('/delete-riwayat-sertifikasi/{id}', [SertifikasiController::class, 'delete']);
    Route::get('/dokumen-sertifikasi/{id}', [SertifikasiController::class, 'getDokumenSertifikasi']);

    Route::get('/dashboard/prestasi-anggota', [PrestasiController::class, 'getPrestasi']);
    Route::post('/dashboard/prestasi-anggota', [PrestasiController::class, 'create']);
    Route::get('/delete-prestasi-anggota/{id}', [PrestasiController::class, 'delete']);

    Route::get('/dashboard/pendidikan-terakhir', [PendidikanTerakhirController::class, 'formPendidikanTerakhir']);
    Route::post('/dashboard/pendidikan-terakhir', [PendidikanTerakhirController::class, 'handleFormPendidikanTerakhir']);
    Route::get('/ijazah-pendidikan-terakhir/{id}', [PendidikanTerakhirController::class, 'getIjazah']);
});

Route::middleware(['auth.api.admin'])->group(function () {
    Route::get('/data-ranting/aktif', [RantingController::class, 'getAllRatingActive']);
    Route::get('/data-user/all-by-ranting', [UserController::class, 'getAllUsersByRanting']);
    Route::put('/data-user/update-by-admin/{id}', [UserController::class, 'updateByAdmin']);
    Route::post('/data-user/create-by-admin', [UserController::class, 'storeByAdmin']);
});

Route::middleware(['auth.api.superAdmin'])->group(function () {
    Route::get('/data-ranting/all', [RantingController::class, 'getAllRanting']);
    Route::post('/data-ranting/create', [RantingController::class, 'store']);
    Route::put('/data-ranting/update/{id}', [RantingController::class, 'update']);
    Route::put('/data-ranting/switch/{id}', [RantingController::class, 'switchStatus']);

    Route::get('/data-admin/all', [AdminController::class, 'getAllAdmins']);
    Route::post('/data-admin/create', [AdminController::class, 'createAdmin']);
    Route::put('/data-admin/update/{id}', [AdminController::class, 'updateAdmin']);
    Route::put('/data-admin/switch/{id}', [AdminController::class, 'switchStatus']);

    Route::get('/data-user/all', [UserController::class, 'getAllUsers']);
    Route::post('/data-user/create', [UserController::class, 'store']);
    Route::put('/data-user/update/{id}', [UserController::class, 'update']);
    Route::put('/data-user/switch/{id}', [UserController::class, 'switchStatus']);
});
