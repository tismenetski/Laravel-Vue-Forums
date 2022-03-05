<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TopicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register' , [AuthController::class,'register']);
Route::post('/login' , [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request){
        return $request->user();
    });
    Route::post('/logout', [AuthController::class,'logout']);
});

Route::controller(CategoryController::class)->prefix('categories')->group(function (){
    Route::get('/', [CategoryController::class,'index']);
    Route::get('/{id}' , [CategoryController::class,'show']);
});

Route::controller(TopicController::class)->prefix('topics')->group(function (){
    Route::get('/{category_id}', [TopicController::class,'index']);
    Route::post('/' , [TopicController::class, 'create']);
    Route::delete('/topic/{id}', [TopicController::class,'destroy']);
});

Route::controller(PostController::class)->prefix('posts')->group(function (){
    Route::get('/{topic_id}' , [PostController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/' , [PostController::class, 'create']);
    Route::get('/post/{id}', [PostController::class, 'show']);
    Route::middleware('auth:sanctum')->put('/post/{id}' , [PostController::class, 'update']);
    Route::middleware('auth:sanctum')->delete('/post/{id}', [PostController::class,'destroy']);
});

Route::controller(CommentController::class)->prefix('comments')->group(function (){
    Route::middleware('auth:sanctum')->post('/', [CommentController::class,'create']);
});

Route::controller(ReplyController::class)->prefix('replies')->group(function (){
    Route::middleware('auth:sanctum')->post('/', [ReplyController::class,'create']);
    Route::middleware('auth:sanctum')->delete('/reply/{id}', [ReplyController::class,'destroy']);
    Route::middleware('auth:sanctum')->put('/reply/{id}', [ReplyController::class,'update']);
});
