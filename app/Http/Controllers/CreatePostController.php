<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PostRequst;

class CreatePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PostRequst $request)
    {
        $accessToken = env('REDDIT_TOKEN');
        $userAgent = env('EDDIT_USER_NAME');

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
            'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent
            ])->post('https://oauth.reddit.com/api/submit', [
                'title' => $request->title,
                'text' => $request->text,
                'sr' => "u_$request->sr",
            ]);
    
        if ($response->ok()) {
            return response()->json(['successful ' => 'Create Post Reddit']);
        } else {
            return response()->json();
        }
    }
}
