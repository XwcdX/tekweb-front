<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginOrRegist(Request $request)
    {
        return view("loginOrRegist", [
            'title' => 'LoginOrRegist',
        ]);
    }
    public function googleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function processLogin()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            if (!$user) {
                return redirect()->route('loginOrRegist')->with('Error', 'Please try to log in again!');
            }

            $email = strtolower($user->getEmail());
            $name = $user->getName();

            if (!str_ends_with($email, '@john.petra.ac.id')) {
                return redirect()->route('loginOrRegist')->with('Error', 'Please use your Petra Christian University email to log in!');
            }

            $apiUrl = env('API_URL') . '/login';

            $response = Http::post($apiUrl, [
                'name' => $name,
                'email' => $email,
                'password' => env('API_SECRET')
            ]);

            if ($response->failed()) {
                return redirect()->route('loginOrRegist')->with('Error', 'There was an issue with the login request.');
            }

            $responseData = $response->json();
            $storedUser = $responseData['data'];
            if (!isset($storedUser['email'], $storedUser['name'], $storedUser['token'])) {
                return redirect()->route('loginOrRegist')->with('Error', 'Invalid response structure from the API.');
            }

            session([
                'email' => $storedUser['email'],
                'name' => $storedUser['name'],
                'token' => $storedUser['token']
            ]);
            $url = session('url');
            if ($url) {
                session()->forget('url');
                return redirect()->to($url);
            }
            return redirect()->route('loginOrRegist');
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect()->route('loginOrRegist')->with('Error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function submitRegister(Request $request)
    {
        $apiUrl = env('API_URL') . '/register';
        $response = HTTP::post($apiUrl, [
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);
        $res = $response->json();
        return response()->json([
            'ok' => isset($res['success']) ? $res['success'] : false,
            'message' => $res['message'] ?? 'An error occurred during registration.',
        ], $response->status());
    }

    public function manualLogin(Request $request)
    {
        Log::info($request->all());
        $apiUrl = env('API_URL') . '/manualLogin';
        $response = HTTP::post($apiUrl, [
            'usernameOrEmail' => $request->get('usernameOrEmail'),
            'loginPassword' => $request->get('loginPassword')
        ]);
        Log::info($response);
        if ($response->failed()) {
            return redirect()->route('loginOrRegist')->with('Error', 'There was an issue with the login request.');
        }

        $responseData = $response->json();
        $storedUser = $responseData['data'];
        if (!isset($storedUser['email'], $storedUser['name'], $storedUser['token'])) {
            return redirect()->route('loginOrRegist')->with('Error', 'Invalid response structure from the API.');
        }

        session([
            'email' => $storedUser['email'],
            'name' => $storedUser['name'],
            'token' => $storedUser['token']
        ]);
        $url = session('url');
        if ($url) {
            session()->forget('url');
            return redirect()->to($url);
        }
        Log::info(session()->all());
        return redirect()->route('loginOrRegist');
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');
    }
}
