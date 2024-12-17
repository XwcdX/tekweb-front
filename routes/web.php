<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home', ['title' => 'coba']);
// });
// Route::get('/home', [UserController::class, 'home'])->name('home');
Route::get('/popular', [UserController::class, 'popular'])->name('popular');

Route::get('/ask', [UserController::class, 'askPage'])->name('askPage');
Route::post('/nembakAsk', [UserController::class, 'nembakAsk'])->name('nembakAsk');

Route::get('/questionUI', [UserController::class, 'testUI']);
Route::get('/viewUser/{email}', [MainController::class, 'viewOther'])->name('viewOthers');

Route::get('/loginOrRegist', [AuthController::class, 'loginOrRegist'])->name('loginOrRegist');
Route::post('/manualLogin', [AuthController::class, 'manualLogin'])->name('manualLogin');
Route::post('/submitRegister', [AuthController::class,'submitRegister'])->name('submitRegister');
Route::get('/email/verify', [AuthController::class, 'verifyEmail'])->name('email.verify');
Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');

Route::get('/auth', [AuthController::class, 'googleAuth'])->name('auth');
Route::get('/process/login', [AuthController::class, 'processLogin'])->name('processLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [MainController::class, 'home'])->name('home');

Route::middleware(['isLogin'])->group(function () {
    // Route::get('/{id}', [UserController::class, 'viewOther']);
    Route::post('/follow', [UserController::class, 'nembakFollow'])->name('nembakFollow');
});

Route::get('/myProfile', [UserController::class, 'seeProfile'])->name('seeProfile');
Route::get('/editProfile', [UserController::class, 'editProfile'])->name('editProfile');

// view questions
Route::get('/viewUsers', [MainController::class, 'viewAllUsers'])->name('viewAllUsers');
Route::get('/viewAnswers/{questionId}', [MainController::class, 'viewAnswers'])->name('user.viewQuestions');
Route::get('/viewTags', [UserController::class, 'viewTags'])->name('viewAllTags');
Route::get('/viewUser/{email}', [MainController::class, 'viewUser'])->name('viewUser');
Route::post('/submitAnswer/{questionId}', [AnswerController::class, 'submitAnswer'])->name('submitAnswer');
Route::post('/addQuestion', [QuestionController::class, 'addQuestion'])->name('addQuestion');
Route::post('/submit/question/comment/{questionId}', [QuestionController::class, 'submitQuestionComment'])->name('question.comment.submit');

// view tags

