<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\ExporterMiddleware;
use App\Http\Middleware\MinicomMiddleware;
use App\Http\Middleware\SellerMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
ROute::view('/login', 'auth.login')->name('login');

Route::group(["prefix" => "auth", "as" => "auth."], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
});

Route::group(["prefix" => "seller", "as" => "seller.", 'middleware' => SellerMiddleware::class], function () {
    Route::get('/', function () {
        return "Welcome Seller!";
    });
});

Route::group(["prefix" => "exporter", "as" => "exporter.", 'middleware' => ExporterMiddleware::class], function () {
    Route::get('/', function () {
        return "Welcome Exporter!";
    });
});

Route::group(["prefix" => "minicom", "as" => "minicom.", 'middleware' => MinicomMiddleware::class], function () {
    Route::get('/', function () {
        return "Welcome Minicom!";
    });
});
