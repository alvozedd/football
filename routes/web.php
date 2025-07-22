<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isPlayer()) {
        return redirect()->route('player.dashboard');
    } elseif ($user->isCoach()) {
        return redirect()->route('coach.dashboard');
    } elseif ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Player routes
Route::middleware(['auth', 'role:player'])->prefix('player')->name('player.')->group(function () {
    Route::get('/dashboard', [PlayerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [PlayerController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile', [PlayerController::class, 'storeProfile'])->name('profile.store');
    Route::put('/profile', [PlayerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
    Route::get('/feedback', [PlayerController::class, 'feedback'])->name('feedback');
});

// Coach routes
Route::middleware(['auth', 'role:coach'])->prefix('coach')->name('coach.')->group(function () {
    Route::get('/dashboard', [CoachController::class, 'dashboard'])->name('dashboard');
    Route::get('/players', [CoachController::class, 'players'])->name('players');
    Route::get('/players/{player}', [CoachController::class, 'showPlayer'])->name('players.show');
    Route::post('/feedback', [CoachController::class, 'storeFeedback'])->name('feedback.store');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::delete('/videos/{video}', [AdminController::class, 'deleteVideo'])->name('videos.delete');
    Route::delete('/feedback/{feedback}', [AdminController::class, 'deleteFeedback'])->name('feedback.delete');
});

require __DIR__.'/auth.php';
