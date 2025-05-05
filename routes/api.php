<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ObatController;
use App\Http\Controllers\Api\SaranKesehatanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// http://127.0.0.1:8000/api/user

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


route::post('/login', [AuthController::class, 'login']);
route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); 
route::patch('/ubah-password', [AuthController::class, 'ubahPassword'])->middleware('auth:sanctum'); 

route::get('/all-kategories', [KategoriController::class, 'index'])->middleware('auth:sanctum');

route::apiResource('all-obat', ObatController::class)->middleware('auth:sanctum');

Route::get('/saran-kesehatan', [SaranKesehatanController::class, 'index'])->middleware('auth:sanctum');

