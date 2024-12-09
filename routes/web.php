<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('otherProfiles', ['title' => 'coba']);
});

Route::get('/loginOrRegist', [AuthController::class, 'loginOrRegist'])->name('loginOrRegist');
Route::post('/manualLogin', [AuthController::class, 'manualLogin'])->name('manualLogin');
Route::post('/submitRegister', [AuthController::class,'submitRegister'])->name('submitRegister');
Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
Route::get('/process/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/search-user', [UserController::class, 'searchUser'])->name('searchUser'); 

Route::middleware(['isLogin'])->group(function () {
    Route::get('/{id}', [UserController::class, 'viewOther']);
    Route::post('/follow', [UserController::class, 'nembakFollow'])->name('nembakFollow');
});
