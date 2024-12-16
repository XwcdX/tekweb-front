<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AnswerController extends Controller
{
    protected $userController;
    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }
    public function getAllAnswers($id)
    {
        $api_url = env('API_URL') . '/answers/' . $id;
        $response = Http::get($api_url);
        $response = json_decode($response, true);
        dd($response['data']);
        return $response['data'];
    }

    public function submitAnswer(Request $request, $questionId)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'answer' => 'required|string',
            'images' => 'nullable|array', 
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',  
        ]);
    
        $data = [];
        $answer = $request->input('answer');
        $data["answer"] = $answer;
    
        $images = $request->file('images');  
    
        $imagePaths = [];
        if ($images) {
            $timestamp = now()->format('Y-m-d_H-i-s');  
    
            foreach ($images as $index => $image) {
                $extension = $image->getClientOriginalExtension();
                $customFileName = "a_" . session('email') . "_" . $questionId . "_" . $timestamp . "_" . ($index + 1) . "." . $extension;
    
                $path = $image->storePubliclyAs("uploads/answers/" . $questionId, $customFileName, 'public');
                $imagePaths[] = $path;  
            }
    
            $data['image_paths'] = json_encode($imagePaths);
        }

    
        $api_url = env('API_URL') . '/submit/answers/' . $questionId . session('email');
        $response = Http::post($api_url, $data);
    
        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Answer submitted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to submit answer.']);
        }
    }
}    
