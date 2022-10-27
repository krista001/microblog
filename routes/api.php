<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Resources\PostResource;
use App\Models\Post;

use App\Http\Resources\UserResource;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/post/{post}', function (Post $post) {
    return new PostResource($post);
})->middleware('can:view,post');

Route::get('/posts', function () {
    return PostResource::collection(Post::where('is_private', 0)->paginate(50));   
});

Route::get('/user/{user}', function (User $user) {
    return new UserResource($user);   
});