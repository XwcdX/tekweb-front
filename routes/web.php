<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'loginOrRegist'])->name('loginOrRegist');
Route::post('/submitRegister', [AuthController::class,'submitRegister'])->name('submitRegister');
Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
Route::get('/process/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');