<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodewarController;

Route::get('/', [CodewarController::class, 'home']);
Route::get('/challenge/{name}', [CodewarController::class, 'run']);
Route::post('/challenge/{name}', [CodewarController::class, 'submit']);

