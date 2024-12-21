<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'hotel']);

route::get('/home', [AdminController::class, 'index'])->name('home')->middleware('auth');

