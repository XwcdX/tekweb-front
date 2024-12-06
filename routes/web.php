<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('otherProfiles', ['title' => 'coba']);
});
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/popular', [UserController::class, 'popular'])->name('popular');
Route::get('/ask', [UserController::class, 'askPage'])->name('askPage');
Route::get('/questionUI', [UserController::class, 'testUI']);

Route::get('/loginOrRegist', [AuthController::class, 'loginOrRegist'])->name('loginOrRegist');
Route::post('/manualLogin', [AuthController::class, 'manualLogin'])->name('manualLogin');
Route::post('/submitRegister', [AuthController::class,'submitRegister'])->name('submitRegister');
Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
Route::get('/process/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/follow', [UserController::class, 'nembakFollow'])->name('nembakFollow');

// Route::get('/search-user', [UserController::class, 'search']); 
Route::get('/{id}', [UserController::class, 'viewOther']);