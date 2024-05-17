<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\{ CreatePostController, UpdatePostController, DeletePostController,
    UpVotePostController, DownVotePostController, CommentController, AllMyPostController, RedditAPIController };

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserController::class)->group(function(){
    Route::post('login','loginUser');
});

Route::controller(RedditAPIController::class)->group(function(){
    Route::get('all-post','index');
});


Route::post('/create-post', CreatePostController::class);
Route::put('/update-post/{postId}', UpdatePostController::class);
Route::delete('/delete-post/{postId}', DeletePostController::class);
Route::post('/up-vote-post/{postId}', UpVotePostController::class);
Route::post('/down-vote-post/{postId}', DownVotePostController::class);
Route::post('/comment/{postId}', CommentController::class);
Route::get('/all-my-post', AllMyPostController::class);
