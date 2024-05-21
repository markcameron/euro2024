<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('fixtures/{fixture}', fn () => '')->name('fixtures.show');
Route::get('predictions/{fixture}', fn () => '')->name('predictions.show');
