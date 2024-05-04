<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/logout', [LoginController::class,'logout']);
Route::match(['get','post'],'/admin/login', [LoginController::class,'adminLogin'])->middleware('has_auth')->name('admin.login');
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('/category', CategoryController::class);
});
