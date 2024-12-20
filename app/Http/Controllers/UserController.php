<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use DateTime;

class UserController extends Controller
{

    public function getAllUsers()
    {
        $api_url = env('API_URL') . '/users';
        $response = Http::withToken(session('token'))->get($api_url);
        $responseData = json_decode($response, true);
        // dd($api_url);
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

        // Sort users by newest (created_at descending)
        $usersByNewest = $users;
        usort($usersByNewest, function ($a, $b) {
            // Ensure created_at is parsed as a DateTime object for proper comparison
            $dateA = new DateTime($a['created_at']);
            $dateB = new DateTime($b['created_at']);
            return $dateB <=> $dateA; // descending order
        });

        // Log the results for debugging
        Log::info("Users ordered by reputation: " . print_r($usersByReputation, true));
        Log::info("Users ordered by vote: " . print_r($usersByVote, true));
        Log::info("Users ordered by new user: " . print_r($usersByNewest, true));

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
        ]);

        return response()->json([
            'ok' => isset($response['success']) ? $response['success'] : false,
            'message' => $response['message'] ?? 'An error occurred during execution.',
            'data' => $response['data'] ?? ''
        ], $response->status());
    }
    public function recommendation(){
        $api_url = env('API_URL') . '/userWithRecommendation';
        // $data['email']  = session('email');
        $data['email']  = 'user1@example.com';

        
        $response = Http::withToken(session('token'))->get($api_url, $data);
        $responseData = json_decode($response, true);
        // dd($responseData['data']);

        // Filter users where is_recommended is true
        $recommendedUsers = array_filter($responseData['data'], function($user) {
            return $user['is_recommended'] === true;
        });

        $recommendedUsers = array_slice($recommendedUsers, 0, 5);
        // dd($recommendedUsers);
        return $recommendedUsers;
    }

    
    

   



    
   




}
