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

        if (!$accessToken && !$userAgent) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
            'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent,
        ])->get("https://oauth.reddit.com/user/{$username}/submitted");

        if ($response->ok()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Failed to fetch post  Reddit API']);
        }
    
    }
}
