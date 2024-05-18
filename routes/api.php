<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\{ CreatePostController, UpdatePostController, DeletePostController,
    VoteCommentController, VotePostController, CommentController, AllMyPostController,
    SearchPostByUserController, AllPostController };

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

Route::post('/create-post', CreatePostController::class);
Route::put('/update-post/{postId}', UpdatePostController::class);
Route::delete('/delete-post/{postId}', DeletePostController::class);
Route::post('/vote-comment', VoteCommentController::class);
Route::post('/vote-post', VotePostController::class);
Route::post('/comment', CommentController::class);
Route::get('/all-my-post/{username}', AllMyPostController::class);
Route::get('/all-post', AllPostController::class);
Route::get('/search-post-user/{username}', SearchPostByUserController::class);
