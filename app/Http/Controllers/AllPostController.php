<?php

namespace App\Http\Controllers;

use App\Services\RedditServiceInterface;
use Illuminate\Http\Request;

class AllPostController extends Controller
{
    protected $redditService;

    public function __construct(RedditServiceInterface $redditService)
    {
        $this->redditService = $redditService;
    }

    public function __invoke(Request $request)
    {
        try {
            $response = $this->redditService->getAllPost();
            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
}
