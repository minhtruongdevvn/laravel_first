<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::resource('note', NoteController::class);
// or
// Route::get('/note', [NoteController::class, 'index'])->name('note.index');
// Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
// Route::get('/note/edit', [NoteController::class, 'edit'])->name('note.edit');
// Route::get('/note/{id}', [NoteController::class, 'show'])->name('note.show');
// Route::post('/note', [NoteController::class, 'store'])->name('note.store');
// Route::put('/note/{id}', [NoteController::class, 'update'])->name('note.update');
// Route::put('/note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
