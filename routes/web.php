<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

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
    // Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::post('/recipes', [RecipeController::class, 'store ']);
    Route::get('/recipes/create', [RecipeController::class, 'create']);
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit']);
    Route::patch('/recipes/{recipe}', [RecipeController::class, 'update']);
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy']);
});

// public recipe routes
Route::get('/latest', [RecipeController::class, 'latest']);
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show']);


require __DIR__.'/auth.php';
