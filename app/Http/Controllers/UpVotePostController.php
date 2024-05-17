<?php

namespace App\Http\Controllers;

use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UpVotePostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $postId)
    {
        $accessToken = ENV('REDDIT_TOKEN');
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
            ])->post("https://oauth.reddit.com/api/vote", [
            'id' => "t3_$postId",
            'dir' => $request->dir,
        ]);
       return  $response;
    }
}
