<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class DeletePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $postId)
    {
        $accessToken = env('REDDIT_TOKEN');
        $userAgent = env('EDDIT_USER_NAME');
        
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
            'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent
            ])->post('https://oauth.reddit.com/api/del', [
                'id' => "t3_$postId",
                ]);
        
        if ($response->ok()) {
            return response()->json(['successful ' => 'Deleted Post Reddit']);
        } else {
            return response()->json();
        }
    }
}
