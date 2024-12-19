<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getAllTags()
    {
        $api_url = env('API_URL') . '/tags';
        $response = Http::withToken(session('token'))->get($api_url);
        $response = json_decode($response, true);
        $tags = $response['data'];
        foreach ($tags as &$tag) {
            $tag['questions'] = (is_array($tag['group_question']) && $tag['group_question'] !== null)
                ? count($tag['group_question'])
                : 0;
        }
        // dd($tags);
        return $tags;
    }
}
