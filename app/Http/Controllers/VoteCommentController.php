<?php

namespace App\Http\Controllers;

use AWS\CRT\HTTP\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoteCommentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $accessToken = ENV('REDDIT_TOKEN');
        $userAgent = env('EDDIT_USER_NAME');

        if (!$accessToken && !$userAgent) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }

        $commentId = $request->comment_id;
        $vote = $request->vote; // 1 for upvote, -1 for downvote, 0 for remove vote

        if (!$commentId || !in_array($vote, [-1, 0, 1])) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
                'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent,
                ])->post("https://oauth.reddit.com/api/vote", [
                    'id' => "t3_$commentId",
                    'dir' => $vote,
                ]);
            return response()->json(['message' => 'Vote recorded successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to record vote'], 500);
        }
    }
}
