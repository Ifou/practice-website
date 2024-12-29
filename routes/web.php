<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', [AdminController::class, 'hotel'])->name('hotel');

// Admin routes

Route::middleware(['auth'])->group(function () {
    route::get('/home', [AdminController::class, 'index'])->name('home')->middleware('auth');
    Route::get('/create_room', [AdminController::class, 'create_room'])->name('create');
    Route::post('/rooms', [AdminController::class, 'store'])->name('rooms.store');
    Route::get('/view_room', [AdminController::class, 'view_room'])->name('view');
    Route::delete('/rooms/{id}', [AdminController::class, 'destroy'])->name('rooms.destroy');
    Route::get('/rooms/{id}/edit', [AdminController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [AdminController::class, 'update'])->name('rooms.update');
    Route::get('/booked_users', [AdminController::class, 'booked_users'])->name('booked');
    Route::delete('/bookings/{id}', [AdminController::class, 'destroyBooking'])->name('bookings.destroy');
    Route::put('/bookings/{id}/approve', [AdminController::class, 'approveBooking'])->name('bookings.approve');
    Route::put('/bookings/{id}/reject', [AdminController::class, 'rejectBooking'])->name('bookings.reject');
    Route::get('/view_contacts', [AdminController::class, 'view_contacts'])->name('view_contacts');
});


// User routes

Route::middleware(['auth'])->group(function () {
    Route::get('/room-details/{id}', [UserController::class, 'getRoomDetails'])->name('room.details');
    Route::get('/book', [UserController::class, 'book'])->name('book');
    Route::post('/book', [UserController::class, 'storeBooking'])->name('book.store');
    Route::post('/contacts', [UserController::class, 'storeContact'])->name('contacts.store');
});

Route::get('/aboutus', [UserController::class, 'aboutus'])->name('aboutus');
Route::get('/viewourroom', [UserController::class, 'viewourroom'])->name('viewourroom');
Route::get('/viewgallery', [UserController::class, 'viewgallery'])->name('viewgallery');
Route::get('/viewcontactus', [UserController::class, 'viewcontactus'])->name('viewcontactus');
