<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class  UserController extends Controller
{
    private $trie;

    public function __construct()
    {
        $this->trie = new Trie();
        $this->initializeTrie();
    }

    // Initialize the Trie with all usernames from the database.
    private function initializeTrie()
    {
        $users = User::select('username')->get();
        foreach ($users as $user) {
            $this->trie->insert($user->username);
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('query', '');
    
        // If there's no query parameter, return the search view
        if (empty($query)) {
            return view('searchUser'); // Return the view with the search bar
        }
    
        // If a query parameter exists, process the search
        $results = $this->trie->search($query);
        return response()->json($results); // Return the results as JSON
    }
    

    public function nembakFollow(Request $reqs)
    {
        $api_url = env('API_URL').'/user/'.$reqs->id.'/follow';
        $response = Http::post($api_url, [
            'email' => $reqs->email,
        ]);
        Log::info($api_url);
    }

}

class TrieNode
{
    public $children = [];
    public $isEndOfWord = false;
}

class Trie
{
    private $root;

    public function __construct()
    {
        $this->root = new TrieNode();
    }

    public function insert(string $word)
    {
        $node = $this->root;
        foreach (str_split($word) as $char) {
            if (!isset($node->children[$char])) {
                $node->children[$char] = new TrieNode();
            }
            $node = $node->children[$char];
        }
        $node->isEndOfWord = true;
    }

    public function search(string $prefix): array
    {
        $node = $this->root;
        foreach (str_split($prefix) as $char) {
            if (!isset($node->children[$char])) {
                return [];
            }
            $node = $node->children[$char];
        }
        return $this->findAllWords($node, $prefix);
    }

    private function findAllWords(TrieNode $node, string $prefix): array
    {
        $words = [];
        if ($node->isEndOfWord) {
            $words[] = $prefix;
        }
        foreach ($node->children as $char => $childNode) {
            $words = array_merge($words, $this->findAllWords($childNode, $prefix . $char));
        }
        return $words;
    }


}
