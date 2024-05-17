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

            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
            ])->post('https://oauth.reddit.com/api/editusertext', [
                'thing_id' => "t3_$postId",
                'api_type' => 'json',
                'text' => $request->text]);

            return $response->json();
    }
}
