<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GetPostDetailsController extends Controller
{
    public function __invoke(Request $request, $postId)
    {
        $accessToken = env('REDDIT_TOKEN');
        $userAgent = env('EDDIT_USER_NAME');

        if (!$accessToken && !$userAgent) {
            return response()->json(['error' => 'User is not authenticated'], 401);
        }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken,
                'User-Agent' => 'ChangeMeClient/0.1 by ' .$userAgent
                ])->get('https://oauth.reddit.com/comments/' . $postId);

            $data = $response->json();

            // Calculate upvotes and downvotes from score and total votes
            $post = $data[0]['data']['children'][0]['data'];
            $comments = $data[1]['data']['children'];
            $upvotes = $post['ups'];
            $downvotes = $post['downs'];
            $totalVotes = $upvotes + $downvotes;

            return response()->json([
                'post' => $post,
                'comments' =>$comments,
                'upvotes' => $upvotes,
                'downvotes' => $downvotes,
                'total_votes' => $totalVotes,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch post details'], 500);
        }
    }

}