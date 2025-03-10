<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::apiResource('contacts', ContactController::class);
    Route::apiResource('opportunities', OpportunityController::class);
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('tags', TagController::class);
    Route::get('/contacts/filter', [ContactController::class, 'filter']);
    Route::get('/opportunities/pipeline', [OpportunityController::class, 'pipeline']);
    Route::get('/tasks/filter', [TaskController::class, 'filter']);
    Route::post('/tags/assign', [TagController::class, 'assign']);
});
