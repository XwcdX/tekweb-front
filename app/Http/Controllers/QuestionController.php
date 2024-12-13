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
        dd($response);
        return $response['data'];
    }
    public function addQuestion(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'question' => 'required|string',
            'images' => 'nullable|array',  // Expecting an array of images
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',  // Validate each image in the array
        ]);

        // Get question data
        $question = $request->input('question');
        $images = $request->file('images');  // Expecting an array of image files

       
        $api_url = env('API_URL') . '/submit/questions/' . session('email');
        Log::info("API URL: " . $api_url);  // Log API URL for debugging

        $data = [
            'question' => $question,
        ];

        if ($images) {
            $uploadedImages = [];
            $count = 1;
            foreach ($images as $image) {
                $timestamp = date('Y-m-d_H-i-s');
                $extension = $image->getClientOriginalExtension();
                $customFileName = "q" .$count . "_" . session('email') . "_" . $timestamp . "." . $extension;

                $path = $image->storeAs("uploads/questions/", $customFileName, 'public');
                $uploadedImages[] = $path;
                $count++;

                Log::info("Image uploaded to: " . $path);  // Log image upload path for debugging
            }

            $data['images'] = $uploadedImages;
        }

        Log::info("Data to be sent: ", $data['images']);

        try {
            $response = Http::post($api_url, $data);

            Log::info("API Response Status: " . $response->status());
            Log::info("API Response Body: " . $response->body());

            if ($response->successful()) {
                return response()->json(['success' => true, 'message' => 'Answer submitted successfully!']);
            } else {
                $errorMessage = $response->json()['message'] ?? 'Failed to submit answer.';
                return response()->json(['success' => false, 'message' => $errorMessage]);
            }
        } catch (\Exception $e) {
            Log::error("Error submitting answer: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error during API request']);
        }
    }
}
