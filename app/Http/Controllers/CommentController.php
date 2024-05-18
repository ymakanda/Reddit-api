<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $accessToken = env('REDDIT_TOKEN');
        $userAgent = env('EDDIT_USER_NAME');

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
            'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent
            ])->post('https://oauth.reddit.com/api/comment', [
            
                'thing_id' => "t3_$request->thing_id",
                'text' => $request->text]);

        return $response->json();
    }
}
