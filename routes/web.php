<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/note')->name('dashboard');

Route::middleware(["auth", "verified"])->group(function () {
    // Route::resource('note', NoteController::class);
    // or
    Route::get('/note', [NoteController::class, 'index'])->name('note.index');

    Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    Route::post('/note', [NoteController::class, 'store'])->name('note.store');

    Route::get('/note/detail/{id}', [NoteController::class, 'detail'])->name('note.detail');
    Route::put('/note/detail/{id}', [NoteController::class, 'update'])->name('note.update');
    Route::delete('/note/detail/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
