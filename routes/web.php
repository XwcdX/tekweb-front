<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'coba']);
});
Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/popular', [UserController::class, 'popular'])->name('popular');

Route::get('/ask', [UserController::class, 'askPage'])->name('askPage');
Route::post('/nembakAsk', [UserController::class, 'nembakAsk'])->name('ask');

Route::get('/questionUI', [UserController::class, 'testUI']);
Route::get('/viewUser/{id}', [UserController::class, 'otherProfiles'])->name('viewOthers');

Route::get('/loginOrRegist', [AuthController::class, 'loginOrRegist'])->name('loginOrRegist');
Route::post('/manualLogin', [AuthController::class, 'manualLogin'])->name('manualLogin');
Route::post('/submitRegister', [AuthController::class,'submitRegister'])->name('submitRegister');
Route::get('/email/verify', [AuthController::class, 'verifyEmail'])->name('email.verify');
Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');

Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
Route::get('/process/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/editProfile', [UserController::class, 'editProfile'])->name('editProfile');

Route::get('/viewAnswers', [UserController::class, 'viewAnswers'])->name('viewAnswers');
Route::get('/viewUsers', [UserController::class, 'viewAllUsers'])->name('viewAllUsers');
Route::get('/viewTags', [UserController::class, 'viewTags'])->name('viewAllUsers');

Route::middleware(['isLogin'])->group(function () {
    Route::post('/follow', [UserController::class, 'nembakFollow'])->name('nembakFollow');
    Route::get('/{id}', [UserController::class, 'viewOther'])->name('viewOther');
});