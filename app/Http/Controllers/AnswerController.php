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
        'title' => 'required|string',
        'question' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5042', // Single image
    ]);
    
    $data = [];
    $answer = $request->input('answer');
    $data["answer"] = $answer;

    // Process the image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image'); // Single image
        $timestamp = now()->format('Y-m-d_H-i-s');
        $extension = $image->getClientOriginalExtension();
        $customFileName = "a_" . session('email') . "_" . $questionId . "_" . $timestamp . "." . $extension;

        // Save the image to storage
        $path = $image->storePubliclyAs("uploads/answers/" . $questionId, $customFileName, 'public');
        $data['image_path'] = $path; // Store as a single string, not an array
    }

    $data['email'] = session('email');
    $data['question_id'] = $questionId;

    // Send the data to the API
    $api_url = env('API_URL') . '/answers';
    $response = Http::withToken(session('token'))->post($api_url, $data);

    if ($response->successful()) {
        return response()->json(['success' => true, 'message' => 'Answer submitted successfully!']);
    } else {
        return response()->json(['success' => false, 'message' => 'Failed to submit answer.']);
    }
}

}    
