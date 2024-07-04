<?php

namespace App\Http\Controllers;

use App\Services\RedditServiceInterface;
use Illuminate\Http\Request;

class AllMyPostController extends Controller
{
    protected $redditService;

    public function __construct(RedditServiceInterface $redditService)
    {
        $this->redditService = $redditService;
    }

    public function __invoke(Request $request, $username)
    {
        try {
            $response = $this->redditService->getAllMyPost($username);
            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
}
