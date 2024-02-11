<?php

use App\Http\Controllers\Api\RecipeController;
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

// All API functions are behind authentication
Route::middleware('auth:api')->group(function () {
    Route::post('/recipes', [RecipeController::class, 'store']);
    Route::patch('/recipes/{recipe:slug}', [RecipeController::class, 'update']);
});
