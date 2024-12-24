<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'hotel'])->name('hotel');

route::get('/home', [AdminController::class, 'index'])->name('home')->middleware('auth');
Route::get('/create_room', [AdminController::class, 'create_room'])->name('create');
Route::post('/rooms', [AdminController::class, 'store'])->name('rooms.store');
Route::get('/view_room', [AdminController::class, 'view_room'])->name('view');
Route::delete('/rooms/{id}', [AdminController::class, 'destroy'])->name('rooms.destroy');
Route::get('/rooms/{id}/edit', [AdminController::class, 'edit'])->name('rooms.edit');
Route::put('/rooms/{id}', [AdminController::class, 'update'])->name('rooms.update');
Route::get('/room-details/{id}', [AdminController::class, 'getRoomDetails'])->name('room.details');
Route::get('/book', [AdminController::class, 'book'])->name('book');
Route::post('/book', [AdminController::class, 'storeBooking'])->name('book.store');
