<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ObatController;


Route::get('/', function () {
    return redirect('/login');
});

// Login dan Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');

    
    Route::get('/obat', [ObatController::class, 'index'])->name('user.obat');
    Route::get('/obat/export', [ObatController::class, 'export'])->name('user.obat.export');
    Route::put('/user/obat/{id}', [ObatController::class, 'update'])->name('user.obat.update');
});

Route::get('/admin', function () {
    return redirect('/admin');
});
