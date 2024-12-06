<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\PseudoTypes\True_;

class  UserController extends Controller
{
    public function viewOther(string $id){ //Ganti Ke email
        $api_url = env('API_URL').'/users/'.$id;
        $response = Http::get($api_url);

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
        $api_url = env('API_URL') . '/users/' . $reqs->email . '/follow';
        $response = Http::post($api_url,[
            'emailCurr' =>session('email')
        ]);

        return response()->json([
            'ok' => isset($response['success']) ? $response['success'] : false,
            'message' => $response['message'] ?? 'An error occurred during execution.',
            'data'=> $response['data'] ?? ''
        ], $response->status());
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
}
