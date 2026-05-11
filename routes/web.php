<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\BookController; // Ensure this is here!
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Event;

// 1. Home
Route::get('/', function () {
    return Inertia::render('Home');
});

// 2. Facilities
Route::get('/facilities', [FacilityController::class, 'showPage'])->name('facilities');
Route::get('/admin/facilities', [FacilityController::class, 'adminPage'])->middleware(['auth', 'verified'])->name('admin.facilities');

// 3. Library (CLEANED UP)
// Public view
Route::get('/library', [BookController::class, 'showPage'])->name('library');

// Admin view (Matches your Facility style)
Route::get('/admin/library', [BookController::class, 'adminPage'])
    ->middleware(['auth', 'verified'])
    ->name('admin.library');

// 4. Events
Route::get('/events', function () {
    return Inertia::render('EventList', [
        'events' => Event::all()
    ]);
});
Route::resource('events', EventController::class);

// 5. Dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 6. Profile & Auth
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 7. Misc
Route::get('/admin-redirect', function () {
    return redirect('http://localhost:5173/admin');
})->name('admin.redirect');