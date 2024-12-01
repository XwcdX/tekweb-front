<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
        return view('profile', ['title' => 'coba']);
    });
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/regist', [AuthController::class, 'regist'])->name('regist');
Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
Route::get('/process/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');