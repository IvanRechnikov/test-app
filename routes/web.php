<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LinksController;

Route::get('/', [PagesController::class, 'index'])->name('home');
Route::post('/compress', [LinksController::class, 'compress'])->name('link.compress');
Route::get('/c/{code}', [LinksController::class, 'open'])->name('link.open');
