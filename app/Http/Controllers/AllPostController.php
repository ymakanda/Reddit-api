<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AllPostController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $response = Http::get("https://www.reddit.com/r/$request->subreddit");

        if ($response->ok()) {
            return $response->json();
        } else {
            return response()->json(['error' => 'Failed to fetch data from Reddit API'], $response->status());
        }
    }
}
