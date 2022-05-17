<?php

use App\Http\Controllers\Api\IngredientController;
use App\Http\Controllers\Api\MeasurementsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('ingredients', [IngredientController::class, 'index']);
Route::get('measurements/{system}', [MeasurementsController::class, 'index']);
Route::post('recipes', [RecipeController::class, 'store']);
