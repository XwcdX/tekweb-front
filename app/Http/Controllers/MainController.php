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
    public function viewUser(string $email){
        $data = $this->userController->getUserFollowers($email);
        // dd($data);
        $data['title'] = 'PROFILE | ' . $data['user']['username'];
        return view('otherProfiles', $data);
    }
      // hrse terima param id question, nih aku cuman mau coba view
      public function viewAnswers($questionId)
      {
        $data['question'] = $this->questionController->getQuestionDetails($questionId);
        $data['title'] = 'View Answers';
        dd($data);
        return view('viewAnswers', $data);
      }

      public function viewAllUsers()
    {
        $data['title'] = 'View Users';
        $user = $this->userController->orderUserBy();
        $data['order_by_reputation'] = $user['users_by_reputation'];
        $data['order_by_vote'] = $user['users_by_vote'];
        $data['order_by_newest'] = $user['users_by_newest'];

        // dd($data);
        return view('viewAllUsers', $data);
    }

  }
  
