<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AllMyPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $username)
    {
        $accessToken = env('REDDIT_TOKEN');
        $userAgent = env('EDDIT_USER_NAME');

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent,
        ])->get("https://oauth.reddit.com/user/{$username}/submitted");

        if ($response->ok()) {
            return $response->json(); //$response->json()['data']['children'];
        } else {
            return response()->json(['error' => 'Failed to fetch post  Reddit API']);
        }
    
    }
}
