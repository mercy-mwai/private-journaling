<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\PlannerEntryController;
use App\Http\Controllers\PlannerMetadataController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function(){
Route::post('/register', [AuthController::class, 'Register']);
Route::post('/login', [AuthController::class, 'Login']);
});


Route::middleware('auth:sanctum')->prefix('auth')->group(function(){
Route::post('/logout', [AuthController::class, 'Logout']);
});

//planner entries Routes

Route::middleware('auth:sanctum')->group(function () {

Route::get('/me', [AuthController::class, 'me']);

Route::get('/planner-entries/week/{startDate}', [PlannerEntryController::class, 'getByWeek']);
Route::get ('/planner-entries/day/{date}', [PlannerEntryController::class, 'getByDay']);
Route::post('/planner-entries', [PlannerEntryController::class, 'Store']);
Route::put('/planner-entries/{id}', [PlannerEntryController::class, 'Update']);
Route::delete('/planner-entries/{id}', [PlannerEntryController::class, 'Destroy']);
});

//planner metadata
Route::middleware('auth:sanctum')->group(function() {
Route::get('/planner-metadata/day/{date}', [PlannerMetadataController::class, 'Show']);
Route::post('/planner-metadata', [PlannerMetadataController::class, 'Store']);
});

//Todo Routes
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/todo/date/{date}', [TodoController::class, 'getByDay']);
    Route::post('/todo', [TodoController::class, 'Store']);
    Route::put('/todo/{id}', [TodoController::class, 'Update']);
    Route::patch('/todo/{id}/toggle', [TodoController::class], 'Toggle');
    Route::delete('/todo/{id}', [TodoController::class, 'Destroy']);
});