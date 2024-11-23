<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function regist(Request $request)
    {
        return view("regist", [
            'title' => 'Regist',
        ]);
    }
    public function login(Request $request)
    {
        return view("login", [
            'title' => 'Login',
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
                return redirect()->route('login')->with('Error', 'Please try to log in again!');
            }

            $email = strtolower($user->getEmail());
            $name = $user->getName();

            if (!str_ends_with($email, '@john.petra.ac.id')) {
                return redirect()->route('login')->with('Error', 'Please use your Petra Christian University email to log in!');
            }

            $nrp = strtolower(substr($email, 0, 9));
            $apiUrl = env('API_URL') . '/login';

            $response = Http::post($apiUrl, [
                'name' => $name,
                'email' => $email,
                'password' => env('API_SECRET')
            ]);

            if ($response->failed()) {
                return redirect()->route('login')->with('Error', 'There was an issue with the login request.');
            }

            $responseData = $response->json();
            $storedUser = $responseData['data'];
            if (!isset($storedUser['email'], $storedUser['name'], $storedUser['token'])) {
                return redirect()->route('login')->with('Error', 'Invalid response structure from the API.');
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
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect()->route('login')->with('Error', 'An unexpected error occurred. Please try again.');
        }
    }


    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('home');
    }
}
