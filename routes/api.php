<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum', AdminMiddleware::class)->group(function(){
    Route::get('/admin', function (Request $request) {
        return $request->user();
    });
});

// Route::get('/test', function () {
//     return response()->json('hello');
// });

Route::post('/login', [AuthController::class, ('login')])->name('login');

Route::prefix('v1/')->group(function(){
    // Route::get('posts', [PostController::class, ('index')]);
    // Route::get('posts/{post}', [PostController::class, ('show')]);
    // Route::post('posts', [PostController::class, ('store')]);
    // Route::put('posts/{post}', [PostController::class, ('update')]);
    // Route::delete('posts/{post}', [PostController::class, ('destroy')]);

    Route::apiResource('posts',PostController::class);
});