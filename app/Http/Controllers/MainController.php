<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Container\Attributes\Tag;

class MainController extends Controller
{
  public $userController;
  public $answerController;
  public $questionController;
  public $tagController;
  public function __construct(UserController $userController, AnswerController $answerController, QuestionController $questionController, TagController $tagController)
  {
    $this->userController = $userController;
    $this->answerController = $answerController;
    $this->questionController = $questionController;
    $this->tagController = $tagController;
  }
  public function home(Request $request)
  {
    $email = session('email');
    $user = $this->userController->getUserByEmail($email);
    $data['username'] = $user['username'];
    $data['image'] = $user['image'];
    $data['title'] = 'Home';
    $questions = $this->questionController->getAllQuestions($request);
    $data['questions'] = $questions;
    // dd($data);
    return view('home', $data);
  }
  public function popular(Request $request)
  {
    $email = session('email');
    $user = $this->userController->getUserByEmail($email);
    $data['username'] = $user['username'];
    $data['image'] = $user['image'];
    $data['title'] = 'Home';
    $questions = $this->questionController->getAllQuestionsByPopularity($request);
    $data['questions'] = $questions;
    // dd($data);
    return view('popular', $data);
  }
  public function viewUser(string $email)
  {
    $data = $this->userController->getUserFollowers($email);
    $currUser = $this->userController->getUserByEmail(session('email'));
    $data['image'] = $currUser['image'];
    $data['title'] = 'PROFILE | ' . $data['user']['username'];
    return view('otherProfiles', $data);
  }
  // hrse terima param id question, nih aku cuman mau coba view
  public function viewAnswers($questionId)
  {
    $data['question'] = $this->questionController->getQuestionDetails($questionId);
    $currUser = $this->userController->getUserByEmail(session('email'));
    $data['image'] = $currUser['image'];
    $data['title'] = 'View Answers';
    // dd($data);
    return view('viewAnswers', $data);
  }

  public function viewAllUsers()
  {
    $data['title'] = 'View Users';
    $user = $this->userController->orderUserBy();

    $usersByReputation = $user['users_by_reputation'];
    $usersByVote = $user['users_by_vote'];
    $usersByNewest = $user['users_by_newest'];

    // hapus user yang login dari view All User
    if (session()->has('email')) {
      $loggedInUserEmail = session('email');

      $usersByReputation = array_filter($usersByReputation, function ($user) use ($loggedInUserEmail) {
        return $user['email'] !== $loggedInUserEmail;
      });

      $usersByVote = array_filter($usersByVote, function ($user) use ($loggedInUserEmail) {
        return $user['email'] !== $loggedInUserEmail;
      });

      $usersByNewest = array_filter($usersByNewest, function ($user) use ($loggedInUserEmail) {
        return $user['email'] !== $loggedInUserEmail;
      });

      // Re-index array
      $usersByReputation = array_values($usersByReputation);
      $usersByVote = array_values($usersByVote);
      $usersByNewest = array_values($usersByNewest);
    }

    $data['order_by_reputation'] = $usersByReputation;
    $data['order_by_vote'] = $usersByVote;
    $data['order_by_newest'] = $usersByNewest;

    return view('viewAllUsers', $data);
  }

  public function viewTags()
  {
    $tags = $this->tagController->getAllTags();
    $data['tags'] = $tags;
    $data['title'] = 'View Tags';
    return view('viewTags', $data);
  }
}
