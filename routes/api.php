<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AuthController;

// ---> 1. ADD THIS IMPORT <---
use App\Http\Controllers\BookController; 
// (Note: If you put BookController in the Api folder, make sure this says App\Http\Controllers\Api\BookController)


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ---> 2. ADD THE PUBLIC BOOK ROUTE HERE <---
Route::get('/books', [BookController::class, 'index']);


// Protected Admin Routes
Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    // Only admins can access these
    Route::apiResource('students', StudentController::class); // (Make sure you import StudentController at the top too if you use this!)
    
    // ---> 3. ADD THE PROTECTED BOOK ROUTES HERE <---
    Route::post('/books', [BookController::class, 'store']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
});

// Your event routes
Route::apiResource('events', EventController::class);