<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpdatePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $postId)
    {
        $accessToken = env('REDDIT_TOKEN');
        $userAgent = env('EDDIT_USER_NAME');

        if (!$accessToken && !$userAgent) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
            'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent
            ])->post('https://oauth.reddit.com/api/editusertext', [
                'thing_id' => "t3_$postId",
                'text' => $request->text
            ]);

        return $response->json();
    }
}
