<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    public function getAllQuestions()
    {
        $api_url = env('API_URL') . '/questions';
        $response = Http::get($api_url);
        $response = json_decode($response, true);
        // dd($response['data']);
        return $response['data'];
    }
    public function addQuestion(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string',
            'question' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5042',  // 5042 KB = 5 MB
        ]);
    
        // Get question data
        $title = $request->input('title');
        $question = $request->input('question');
        $image = $request->file('image');  // Expecting a single image file
    
        $api_url = env('API_URL') . '/submit/questions/' . session('email');
        Log::info("API URL: " . $api_url);  // Log API URL for debugging
    
        $data = [
            'title' => $title,
            'question' => $question,
        ];
    
        // If an image is uploaded, process it
        if ($image) {
            $timestamp = date('Y-m-d_H-i-s');
            $extension = $image->getClientOriginalExtension();
            $customFileName = "q_" . session('email') . "_" . $timestamp . "." . $extension;
    
            // Store the image in the public storage folder
            $path = $image->storeAs("uploads/questions/", $customFileName, 'public');
            $data['image'] = $path;
    
            Log::info("Image uploaded to: " . $path);  // Log image upload path for debugging
        }
    
        Log::info("Data to be sent: ", $data);
    
        try {
            $response = Http::post($api_url, $data);
    
            Log::info("API Response Status: " . $response->status());
            Log::info("API Response Body: " . $response->body());
    
            if ($response->successful()) {
                return response()->json(['success' => true, 'message' => 'Question submitted successfully!']);
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to submit question.';
                return response()->json(['success' => false, 'message' => $errorMessage]);
            }
        } catch (\Exception $e) {
            Log::error("Error submitting question: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error during API request']);
        }
    }
    
}
