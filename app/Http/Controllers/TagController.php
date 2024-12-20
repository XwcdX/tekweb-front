<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function getAllTags()
    {
        $api_url = env('API_URL') . '/tags';
        $response = Http::withToken(session('token'))->get($api_url);
        $tags = json_decode($response, true);
        foreach ($tags as &$tag) {
            $tag['questions'] = (is_array($tag['group_question']) && $tag['group_question'] !== null)
                ? count($tag['group_question'])
                : 0;
        }
        // dd($tags);
        return $tags;
    }

    public function getTagOnly()
    {
        $api_url = env('API_URL') . '/tagOnly';
        $response = Http::withToken(session('token'))->get($api_url);
        $tags = json_decode($response, true);
        return $tags;
    }
    public function getTagLeaderboard($tagId){
        $api_url = env('API_URL') . '/getLeaderboardByTag';
        $data['tag_id'] = $tagId;
        $data['top_n'] = 3;
        Log::info("data:", $data);

        $response = Http::withToken(session('token'))->get($api_url, $data);
        $responseData = json_decode($response, true);
        // dd($responseData['data']);
        Log::info("data:", $responseData['data']);
        return $responseData['data'];
    }
}
