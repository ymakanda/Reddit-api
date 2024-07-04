<?php

namespace App\Services;

interface RedditServiceInterface
{
    public function getAllMyPost(string $username);
    public function getAllPost();
    public function searchPostByUser(string $username);
}
