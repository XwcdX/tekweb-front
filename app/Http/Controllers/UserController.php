<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class  UserController extends Controller
{
    public function viewOther(string $id){
        $api_url = env('API_URL').'/users/'.$id;
        $response = Http::withToken(session('token'))->get($api_url);
        $response = json_decode($response, true);

        $user = $response['data'] ?? ['username'=>'User Profile','followers'=>[]];
        
        $currUserId = session('email');

        $followers = collect($user['followers']); // Apakah currUser masuk/exist di user->followers

        $apakahFollow = false;
    
        foreach ($followers as $follower){
            if($follower['email'] == $currUserId){
                $apakahFollow = True;
                break;
            }
        }
        $countFollowers = count($followers);
        
        $title = 'PROFILE | '.$user['username'];
        return view('otherProfiles', compact('title','user','apakahFollow', 'countFollowers'));
    }

    public function nembakFollow(Request $reqs)
    {
        $api_url = env('API_URL') . '/users/' . $reqs->id . '/follow';
        $response = Http::withToken(session('token'))->post($api_url,[
            'emailCurr' =>session('email')
        ]);

        return response()->json([
            'ok' => isset($response['success']) ? $response['success'] : false,
            'message' => $response['message'] ?? 'An error occurred during execution.',
            'data'=> $response['data'] ?? ''
        ], $response->status());
    }
    
    public function searchUser(){
        $api_url = env('API_URL') . '/userWithRecommendation';
        $response = Http::get($api_url, [
            'email' => 'c14230088@john.petra.ac.id'
        ]);
        $response = json_decode($response, true);
        $users = $response['data'];

        $title = 'Search User | Search User';
        return view('searchUser', compact('title','users'));
    }
}
