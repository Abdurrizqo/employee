<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DashboardSuperAdmin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RantingController;
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

Route::get('/super-admin-login', [LoginController::class, 'superAdminloginPage']);
Route::prefix('super-admin')->group(function () {
    Route::get('/dashboard', [DashboardSuperAdmin::class, 'dashboardSuperAdmin']);
    Route::get('/list-ranting', [DashboardSuperAdmin::class, 'listRantingPage']);
    Route::get('/list-admin', [DashboardSuperAdmin::class, 'listAdminPage']);
    Route::get('/list-anggota', [DashboardSuperAdmin::class, 'listAnggotaPage']);
});

Route::get('/admin-login', [LoginController::class, 'adminloginPage']);
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboardAdmin']);
});

Route::get('/user-login', [LoginController::class, 'userloginPage']);

Route::get('/data-ranting/all', [RantingController::class, 'getAllRanting']);
Route::get('/data-ranting/aktif', [RantingController::class, 'getAllRatingActive']);
Route::get('/data-ranting/create', [RantingController::class, 'store']);
Route::get('/data-ranting/update', [RantingController::class, 'update']);
Route::get('/data-ranting/switch', [RantingController::class, 'switchStatus']);

Route::get('/data-ranting/all', [AdminController::class, 'getAllAdmins']);
Route::get('/data-ranting/create', [AdminController::class, 'createAdmin']);
Route::get('/data-ranting/update', [AdminController::class, 'updateAdmin']);
Route::get('/data-ranting/switch', [AdminController::class, 'switchStatus']);
