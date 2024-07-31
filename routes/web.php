<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
ROute::view('/login', 'auth.login')->name('login');

Route::group(["prefix" => "auth", "as" => "auth."], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
});
