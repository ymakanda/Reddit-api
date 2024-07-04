<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class RedditService implements RedditServiceInterface
{
    protected $token;
    protected $userName;
    protected $url;
    protected $userAgent;
    protected $authorization;

    public function __construct()
    {
        $this->token = env('REDDIT_TOKEN');
        $this->url = 'https://oauth.reddit.com';
        $this->userName = env('REDDIT_USER_NAME');
        $this->userAgent = 'ChangeMeClient/0.1 by ' .$this->userName;
        $this->authorization = 'Bearer ';
    }
    
    public function getAllMyPost(string $username)
    {
        if (!$this->token) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }
        
        $response = Http::withHeaders(['Authorization' => $this->authorization . $this->token,
            'User-Agent' => $this->userAgent
            ])->get($this->url . "/user/$username/submitted");
        
        if ($response->ok()) {
            return $response;
        } else {
            return response()->json(['error' => 'Failed to fetch data from Reddit API']);
        }
    }

    public function searchPostByUser(string $username)
    {
        if (!$this->token) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }
        
        $response = Http::withHeaders(['Authorization' => $this->authorization . $this->token,
            'User-Agent' => $this->userAgent
            ])->get($this->url . "/user/u/$username");
        
        if ($response->ok()) {
            return $response;
        } else {
            return response()->json(['error' => 'Failed to fetch data from Reddit API']);
        }
    }

    public function getAllPost()
    {
        if (!$this->token) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }
        
        $response = Http::withHeaders(['Authorization' => $this->authorization . $this->token,
            'User-Agent' => $this->userAgent
            ])->get($this->url . "/user/self/submitted");
        
        if ($response->ok()) {
            return $response;
        } else {
            return response()->json(['error' => 'Failed to fetch data from Reddit API']);
        }
    }
}
