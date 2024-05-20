<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home page
Route::get('/', [RecipeController::class, 'latest']);

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/recipes', [RecipeController::class, 'store ']);
    Route::get('/recipes/create', [RecipeController::class, 'create']);
    Route::get('/recipes/{recipe:slug}/edit', [RecipeController::class, 'edit']);
    Route::delete('/recipes/{recipe:slug}', [RecipeController::class, 'destroy']);
});

// public recipe routes
Route::get('/latest', [RecipeController::class, 'latest']);
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');
Route::get('/recipes/{recipe:slug}', [RecipeController::class, 'show']);

Route::get('/tags/search', [TagController::class, 'search']);
Route::get('/tags/{tag:name}', [TagController::class, 'show']);

require __DIR__.'/auth.php';
