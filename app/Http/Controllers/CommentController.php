<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $postId)
    {
       
        $accessToken = ENV('REDDIT_TOKEN');
        $response = Http::withToken($accessToken)->post("https://oauth.reddit.com/api/comment", [
            'thing_id' => "t3_$postId",
            'text' => $request->text,
        ]);

        return $response;
    }
}
