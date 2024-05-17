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
        $accessToken = ENV('REDDIT_TOKEN');

        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
            ])->post('https://oauth.reddit.com/api/submit', [
            'title' => $request->title,
            'text' => $request->text,
            'sr' => $request->sr,
        ]);
    
        return  $response;

    }
}
