<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportersController;
use App\Http\Controllers\SellersController;
use App\Http\Middleware\ExporterMiddleware;
use App\Http\Middleware\MinicomMiddleware;
use App\Http\Middleware\SellerMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register');

Route::group(["prefix" => "auth", "as" => "auth."], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
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
    Route::view('/', 'minicom.dashboard');
    Route::view('/documents', 'minicom.documents');
    Route::get('/users', [ExportersController::class, 'index']);
    Route::get('/users/sellers', [SellersController::class, 'index']);
    Route::view('/training', 'minicom.training');
    Route::view('/products', 'minicom.product.sales');
    Route::view('/products/reporting', 'minicom.product.reporting');
    Route::view('/products/declaration', 'minicom.product.declaration');
    Route::view('/notifications', 'minicom.notifications');
    Route::view('/settings', 'auth.settings');
});
