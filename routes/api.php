<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StarWarMovieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::middleware('guest:sanctum')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::any('logout',        [AuthController::class, 'logout'])->name('logout');
    Route::get('movie',         [StarWarMovieController::class, 'index'])->name('movie.index');
    Route::get('movie/{id}',    [StarWarMovieController::class, 'show'])->name('movie.show');
    Route::delete('movie/{id}', [StarWarMovieController::class, 'delete'])->name('movie.delete');
    Route::put('movie/{id}',    [StarWarMovieController::class, 'update'])->name('movie.update');
});


