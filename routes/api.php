<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FacilityController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/books', [BookController::class, 'index']);
Route::get('/facilities', [FacilityController::class, 'index']);
Route::get('/facilities/{id}', [FacilityController::class, 'show']);

// Protected Admin Routes
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    // Only admins can access these
    Route::apiResource('students', StudentController::class); // (Make sure you import StudentController at the top too if you use this!)
    
    // Book management (admin only)
    Route::post('/books', [BookController::class, 'store']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    
    // Facility management (admin only)
    Route::post('/facilities', [FacilityController::class, 'store']);
    Route::put('/facilities/{id}', [FacilityController::class, 'update']);
    Route::delete('/facilities/{id}', [FacilityController::class, 'destroy']);
});

// Your event routes
Route::apiResource('events', EventController::class);