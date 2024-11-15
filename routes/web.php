<?php

use Illuminate\Support\Facades\Route;
use Liamtseva\Cinema\Http\Controllers\SelectionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/selections', [SelectionController::class, 'index']);
