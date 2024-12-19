<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use Illuminate\Pagination\LengthAwarePaginator;


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
    // dd($data);
    $data['title'] = 'PROFILE | ' . $data['user']['username'];
    return view('otherProfiles', $data);
  }
  // hrse terima param id question, nih aku cuman mau coba view
  public function viewAnswers($questionId)
  {
    $data['question'] = $this->questionController->getQuestionDetails($questionId);
    $data['title'] = 'View Answers';
    // dd($data);
    return view('viewAnswers', $data);
  }

  public function viewAllUsers(Request $request)
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
    // Pagination

    $activeTab = $request->input('tab', 'reputations');
    $page = $request->input('page', 1);
    $per_page = 20;
    $offset = ($page - 1) * $per_page;
    $paginatorByReputation = new LengthAwarePaginator(
      array_slice($usersByReputation, $offset, $per_page),
      count($usersByReputation),
      $per_page,
      $page,
      ['path' => $request->url(), 'query' => array_merge($request->query(), ['tab' => 'reputations'])]
    );

    $paginatorByVote = new LengthAwarePaginator(
      array_slice($usersByVote, $offset, $per_page),
      count($usersByVote),
      $per_page,
      $page,
      ['path' => $request->url(), 'query' => array_merge($request->query(), ['tab' => 'voters'])]
    );

    $paginatorByNewest = new LengthAwarePaginator(
      array_slice($usersByNewest, $offset, $per_page),
      count($usersByNewest),
      $per_page,
      $page,
      ['path' => $request->url(), 'query' => array_merge($request->query(), ['tab' => 'new-users'])]
    );
    $data['user_by_reputation'] = $usersByReputation;
    $data['user_by_vote'] = $usersByVote;
    $data['user_by_newest'] = $usersByNewest;
    $data['order_by_reputation'] = $paginatorByReputation;
    $data['order_by_vote'] = $paginatorByVote;
    $data['order_by_newest'] = $paginatorByNewest;
    $data['active_tab'] = $activeTab;

    return view('viewAllUsers', $data);
  }

}
