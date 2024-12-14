<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;


class MainController extends Controller
{
    public $userController;
    public $answerController;
    public $questionController;
    public function __construct(UserController $userController, AnswerController $answerController, QuestionController $questionController)
    {
        $this->userController = $userController;
        $this->answerController = $answerController;
        $this->questionController = $questionController;
    }
    public function home(){
        $email = session('email');
        $user = $this->userController->getUserByEmail($email);
        $data['username'] = $user['username'];
        $data['image'] = $user['image'];
        $data['title'] = 'Home';
        $questions = $this->questionController->getAllQuestions();
        $data['questions'] = $questions;
        // dd($data);
        return view('home', $data);

    }
  }
