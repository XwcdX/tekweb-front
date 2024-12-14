<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UserController extends Controller
{

    public function getAllUsers()
    {
        $api_url = env('API_URL') . '/users';
        $response = Http::get($api_url);
        $responseData = json_decode($response, true);
        return $responseData['data'];
    }

    public function countUserVote()
    {
        $users = $this->getAllUsers();
        
        foreach ($users as &$user) {
            $countvotes = collect($user['question'])->sum(function ($question) {
                return $question['vote'] ?? 0;  // Default to 0 if no votes
            });
            
            $user['vote_count'] = $countvotes;
            $user['created_at'] = Carbon::parse($user['created_at'])->diffForHumans();
        }
        
        return $users;
    }
    

    public function orderUserBy()
    {
        // Get all users
        $users = $this->countUserVote();

        // Sort users by reputation (descending)
        $usersByReputation = $users;
        usort($usersByReputation, function ($a, $b) {
            return $b['reputation'] - $a['reputation']; // descending order
        });

        // Sort users by vote (descending)
        $usersByVote = $users;
        usort($usersByVote, function ($a, $b) {
            return $b['vote_count'] - $a['vote_count']; // descending order
        });

        $usersByNewest = $users;
        usort($usersByNewest, function ($a, $b) {
            // Format the 'created_at' timestamps into human-readable format
            return strcmp($b['created_at'], $a['created_at']); // descending order
        });


        // Log the results for debugging
        Log::info("Users ordered by reputation: " . print_r($usersByReputation, true));
        Log::info("Users ordered by vote: " . print_r($usersByVote, true));
        Log::info("Users ordered by new user: " . print_r($usersByNewest, true));
        // dd($usersByNewest);
        return [
            'users_by_reputation' => $usersByReputation,
            'users_by_vote' => $usersByVote,
            'users_by_newest' => $usersByNewest,
        ];
    }


    public function getUserByEmail($email)
    {
        // $email = session('email');
        $api_url = env('API_URL') . '/users/get/' . $email;
        $response = Http::withToken(session('token'))->get($api_url);
        $response = json_decode($response, true);
        // dd($response['data']);
        return $response['data'];
    }

    public function getUserFollowers(string $email)
    {
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
        $data['user'] = $user;
        $data['isFollowing'] = $isFollowing;
        $data['countFollowers'] = $countFollowers;
        return $data;
    }



    public function nembakFollow(Request $reqs)
    {
        $api_url = env('API_URL') . '/users/' . $reqs->id . '/follow';
        $response = Http::withToken(session('token'))->post($api_url, [
            'emailCurr' => session('email')
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




    public function viewTags()
    {
    public function viewTags()
    {
        $data['title'] = 'View Tags';
        return view('viewTags', $data);
    }


    public function searchUser()
    {
        $api_url = env('API_URL') . '/userWithRecommendation';
        $response = Http::get($api_url, [
            'email' => 'c14230088@john.petra.ac.id'
        ]);
        $response = json_decode($response, true);
        $users = $response['data'];

        $title = 'Search User | Search User';
        return view('searchUser', compact('title', 'users'));
    }
}
