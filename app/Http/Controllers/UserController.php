<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getAllUsers(){
        $api_url = env('API_URL').'/users';
        $response = Http::get($api_url);
        $response = json_decode($response, true);
        // dd($response['data']);
        return $response['data'];
    }

    public function getUserByEmail($email){
        // $email = session('email');
        $api_url = env('API_URL').'/users/get/'.$email;
        $response = Http::withToken(session('token'))->get($api_url);
        $response = json_decode($response, true);
        // dd($response['data']);
        return $response['data'];
    }
    
    public function viewOther(string $email){

        $user = $this->getUserByEmail($email) ?? ['username' => 'User Profile', 'followers' => []];
        $currUserId = session('email');

        $followers = collect($user['followers']); // Apakah currUser masuk/exist di user->followers

        $isFollowing = false;

        foreach ($followers as $follower) {
            if ($follower['email'] == $currUserId) {
                $isFollowing = True;
                break;
            }
        }
        $countFollowers = count($followers);
        $data['title'] = 'PROFILE | ' . $user['username'];
        $data['user'] = $user;
        $data['isFollowing'] = $isFollowing;
        $data['countFollowers']= $countFollowers;

        return view('otherProfiles', $data);
    }

    public function nembakFollow(Request $reqs)
    {
        $api_url = env('API_URL') . '/users/' . $reqs->id . '/follow';
        $response = Http::withToken(session('token'))->post($api_url, [
            'emailCurr' => session('email')
        ]);

        return response()->json([
            'ok' => isset($response['success']) ? $response['success'] : false,
            'message' => $response['message'] ?? 'An error occurred during execution.',
            'data' => $response['data'] ?? ''
        ], $response->status());
    }
    public function seeProfile()
    {
        $data['title'] = 'My Profile';
        $email = session('email');

        $currUser = $this->getUserByEmail($email);
        $data['currUser'] = $currUser;
        $followers = collect($currUser['followers']); 
        $countFollowers = count($followers);
        $data['countFollowers'] = $countFollowers;
        return view('profile', $data);
    }

        public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        
        $email = session('email');
        $currUser = $this->getUserByEmail($email);
        $data['user'] = $currUser;
        return view('editProfile', $data);
    }

    // public function home()
    // {
    //     $email = session('email');
    //     $user = $this->getUserByEmail($email);
    //     // dd($user);
    //     $data['username'] = $user['username'];
    //     $data['image'] = $user['image'];
    //     $data['title'] = 'Home';
    //     // dd($data);
    //     return view('home', $data);
    // }

   
    public function askPage()
    {
        $data['title'] = 'Ask a Question';
        return view('ask', $data);
    }
    public function popular()
    {
        $data['title'] = 'Popular';
        return view('popular', $data);
    }
    public function testUI()
    {
        $data['title'] = 'Popular';
        return view('question', $data);
    }

    public function viewAllUsers()
    {
        $api_url = env('API_URL') . '/userWithRecommendation';
        $response = Http::get($api_url, []);
        $response = json_decode($response, true);
        $users = $response['data'];
        $users = collect($users)->sortByDesc('reputation');

        $title = 'View Users';
        return view('viewAllUsers', compact(['users', 'title']));
    }
    // hrse terima param id question, nih aku cuman mau coba view
    public function viewAnswers()
    {
        $data['title'] = 'View Answers';
        return view('viewAnswers', $data);
    }

    public function viewTags()
    {
        $data['title'] = 'View Tags';
        return view('viewTags', $data);
    }
    
    public function askPage()
    {
        $api_url = env('API_URL');
        $response = Http::withToken(session('token'))->get($api_url);
        $subjects = json_encode($response, true);
        
        $title = 'Ask a Question';
        return view('ask', compact('title', 'subjects'));
    }

    public function nembakAsk(Request $reqs)
    {
        $api_url = env('API_URL') . '/questions';
        $response = Http::withToken(session('token'))->post($api_url, [
            'vote' => 0,
            'image' => $reqs['image'],
            'question' => $reqs['question'],
        ]);
        Log::info($api_url);
        Log::info($response);
        return response()->json([
            'ok' => isset($response['success']) ? $response['success'] : false,
            'message' => $response['message'] ?? 'An error occurred during execution.',
            'data' => $response['data'] ?? ''
        ], $response->status());
    }
}
