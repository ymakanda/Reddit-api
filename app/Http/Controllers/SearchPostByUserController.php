<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchPostByUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $accessToken = env('REDDIT_TOKEN');
         $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
             ])->get("https://oauth.reddit.com/u/Due-Chemical-6024");

             return $response;
    }
}
