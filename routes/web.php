<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingHomeController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [LandingHomeController::class, 'home'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function() {
    Route::middleware(['auth_admin', 'auth'])->group(function() {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/user', [App\Http\Controllers\AdminController::class, 'list_user'])->name('admin.user');
        Route::post('/add_user', [App\Http\Controllers\AdminController::class, 'add_user'])->name('admin.add.user');
        Route::post('/edit_user', [App\Http\Controllers\AdminController::class, 'edit_user'])->name('admin.edit.user');
        Route::get('/edit_status_user/{id_user}/{next_status}', [App\Http\Controllers\AdminController::class, 'edit_status_user'])->name('admin.edit.status.user');
        Route::get('/koperasi', [App\Http\Controllers\AdminController::class, 'list_koperasi'])->name('admin.koperasi');
        Route::post('/add_koperasi', [App\Http\Controllers\AdminController::class, 'add_koperasi'])->name('admin.add.koperasi');
        Route::post('/edit_koperasi', [App\Http\Controllers\AdminController::class, 'edit_koperasi'])->name('admin.edit.koperasi');
        Route::get('/edit_status_koperasi/{id_koperasi}/{next_status}', [App\Http\Controllers\AdminController::class, 'edit_status_koperasi'])->name('admin.edit.status.koperasi');
        Route::get('/neraca', [App\Http\Controllers\AdminController::class, 'neraca'])->name('admin.report');
    });
});

Route::group(['prefix' => 'user'], function() {
    Route::middleware(['auth_user', 'auth'])->group(function() {
        Route::get('/', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/neraca', [App\Http\Controllers\AdminController::class, 'neraca'])->name('user.report');
        Route::get('/shu', [App\Http\Controllers\AdminController::class, 'shu'])->name('user.shu');
    });
});