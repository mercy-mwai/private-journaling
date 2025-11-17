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
Route::get('/planner_entries/week/{startDate}', [PlannerEntryController::class, 'getByWeek']);
Route::get ('/planner_entries/day/{date}', [PlannerEntryController::class, 'getByDay']);
Route::post('/planner-entries', [PlannerEntryController::class, 'Store']);
Route::put('/planner_entries/{id}', [PlannerEntryController::class, 'Update']);
Route::delete('planner_entries/{id}', [PlannerEntryController::class, 'Destroy']);
});

//planner metadata
Route::middleware('auth:sanctum')->group(function() {
Route::get('/planner_metadata/day/{id}', [PlannerMetadataController::class, 'Show']);
Route::post('/planner_metadata', [PlannerMetadataController::class, 'Store']);
});

//Todo Routes
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/todo/day/{date}', [TodoController::class, 'getByDay']);
    Route::post('/todo', [TodoController::class, 'Store']);
});