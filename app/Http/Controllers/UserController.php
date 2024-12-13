<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function viewOther(string $id)
    {
        $api_url = env('API_URL') . '/users/' . $id;
        $response = Http::withToken(session('token'))->get($api_url);
        $response = json_decode($response, true);

        $user = $response['data'] ?? ['username' => 'User Profile', 'followers' => []];

        $currUserId = session('email');

        $followers = collect($user['followers']); // Apakah currUser masuk/exist di user->followers

        $apakahFollow = false;

        foreach ($followers as $follower) {
            if ($follower['email'] == $currUserId) {
                $apakahFollow = True;
                break;
            }
        }
        $countFollowers = count($followers);

        $title = 'PROFILE | ' . $user['username'];
        return view('otherProfiles', compact('title', 'user', 'apakahFollow', 'countFollowers'));
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
    public function editProfile()
    {
        $data['title'] = 'Edit Profile';
        return view('editProfile', $data);
    }

    public function home()
    {
        $data['title'] = 'Home';
        return view('home', $data);
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

    public function nembakAsk(Request $reqs)
    {
        $api_url =env('API_URL') . '/questions';
        $response = Http::withToken(session('token'))->post($api_url, [
            'vote' => 0,
            'image' => $reqs['image'],
            'question' => $reqs['question'],
        ]);
        Log::info();
        return response()->json([
            'ok' => isset($response['success']) ? $response['success'] : false,
            'message' => $response['message'] ?? 'An error occurred during execution.',
            'data' => $response['data'] ?? ''
        ], $response->status());
    }
}
