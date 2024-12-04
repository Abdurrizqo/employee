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
});

Route::get('/admin-login', [LoginController::class, 'adminloginPage']);
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboardAdmin']);
});

Route::get('/user-login', [LoginController::class, 'userloginPage']);

Route::get('/data-ranting/all', [RantingController::class, 'getAllRanting']);
Route::get('/data-ranting/aktif', [RantingController::class, 'getAllRatingActive']);
Route::post('/data-ranting/create', [RantingController::class, 'store']);
Route::put('/data-ranting/update/{id}', [RantingController::class, 'update']);
Route::put('/data-ranting/switch/{id}', [RantingController::class, 'switchStatus']);

Route::get('/data-admin/all', [AdminController::class, 'getAllAdmins']);
Route::post('/data-admin/create', [AdminController::class, 'createAdmin']);
Route::put('/data-admin/update/{id}', [AdminController::class, 'updateAdmin']);
Route::put('/data-admin/switch/{id}', [AdminController::class, 'switchStatus']);
