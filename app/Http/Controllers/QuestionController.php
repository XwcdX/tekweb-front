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
        $response = Http::withToken(session('token'))->get($api_url);
        $response = json_decode($response, true);

        // Get the data (questions)
        $data = $response['data'];

        // Loop through each question and count comments
        foreach ($data as &$question) {
            // If comments is null or not an array, set it to an empty array, otherwise count the array length
            $question['comments_count'] = (is_array($question['comment']) && $question['comment'] !== null)
                ? count($question['comment'])
                : 0;
        }


        // dd($data);
        // Return the updated data
        return $data;
    }


    public function getQuestionDetails($id)
    {
        $data['email'] = session('email');
        $api_url = env('API_URL') . '/questions/' . $id . '/view';
        $response = Http::post($api_url, $data);
        $response = json_decode($response, true);
        $questionData = $response['data'];

        $comments = collect($questionData['comment']); // Apakah currUser masuk/exist di user->comments
        $countcomments = count($comments);
        $questionData['comment_count'] = $countcomments;
        return $questionData;
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

        $api_url = env('API_URL') . '/questions';

        $data = [
            'title' => $title,
            'question' => $question,
            'email' => session('email'),
            'subject_id' => $request->subject_id
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
            $response = Http::withToken(session('token'))->post($api_url, $data);

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

    public function submitQuestionComment(Request $request, $questionId)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        if (!isset($request->answer_id)) {
            $data['question_id'] = $questionId;
        } else {
            $data['answer_id'] = $questionId;
        }

        $data['email'] = session('email');
        $data['comment'] = $request->comment;
        Log::info("Data to be sent: ", $data);

        $api_url = env('API_URL') . '/comments';
        $response = Http::withToken(session('token'))->post($api_url, $data);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Comment on this Question is submitted successfully!']);
        } else {
            $errorMessage = $response->json()['message'] ?? 'Failed to comment.';
            return response()->json(['success' => false, 'message' => $errorMessage]);
        }
    }

    public function vote(Request $request) 
    {
        // kirim email
        $data['email'] = session('email');
        if($request->vote === true){
            $api_url = env('API_URL') . '/questions/' . $request->question_id . '/upvote';
        }
        else{
            $api_url = env('API_URL') . '/questions/' . $request->question_id . '/downvote';
        }
        $response = Http::withToken(session('token'))->post($api_url, $data);

        if ($response->successful()) {
            return response()->json(['success' => true, 'message' => 'Your Vote has been recorded']);
        } else {
            $errorMessage = $response->json()['message'] ?? 'Failed to comment.';
            return response()->json(['success' => false, 'message' => $errorMessage]);
        }
    }
}
