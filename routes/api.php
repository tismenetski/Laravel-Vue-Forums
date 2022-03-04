<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->group(function (){

    Route::get('/user', function (Request $request){
        return $request->user();
    });


    Route::post('/logout', [AuthController::class,'logout']);

});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//
//
//});


Route::get('/categories', [CategoryController::class,'index']);
Route::get('/categories/{id}' , [CategoryController::class,'show']);

Route::get('/topics/{category_id}', [TopicController::class,'index']);
Route::post('/topics' , [TopicController::class, 'create']);
Route::delete('/topics/topic/{id}', [TopicController::class,'destroy']);

Route::get('/posts/{topic_id}' , [PostController::class, 'index']);
Route::middleware('auth:sanctum')->post('/posts' , [PostController::class, 'create']);
Route::get('posts/post/{id}', [PostController::class, 'show']);
Route::middleware('auth:sanctum')->put('posts/post/{id}' , [PostController::class, 'update']);
Route::middleware('auth:sanctum')->delete('posts/post/{id}', [PostController::class,'destroy']);



Route::post('/register' , [AuthController::class,'register']);
Route::post('/login' , [AuthController::class,'login']);
