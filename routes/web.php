<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('fixtures', 'fixtures')
    ->middleware(['auth', 'verified'])
    ->name('fixtures.index');

Route::view('fixtures/{fixture}', 'fixture-detail')
    ->middleware(['auth', 'verified'])
    ->name('fixtures.show');

Route::view('predictions', 'predictions')
    ->middleware(['auth', 'verified'])
    ->name('predictions.index');

Route::view('predictions/{fixture}', 'prediction-detail')
    ->middleware(['auth', 'verified'])
    ->name('predictions.show');

require __DIR__.'/auth.php';
