<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExportersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\TrainingController;
use App\Http\Middleware\ExporterMiddleware;
use App\Http\Middleware\MinicomMiddleware;
use App\Http\Middleware\SellerMiddleware;
use App\Models\Training;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register');

Route::group(["prefix" => "auth", "as" => "auth."], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
    Route::post('/settings', [AuthController::class, 'profile']);
});

Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth');

Route::group(["prefix" => "seller", "as" => "seller.", 'middleware' => SellerMiddleware::class], function () {
    Route::view('/', 'seller.rules');
    Route::view('/settings', 'auth.settings');
    Route::resource('/training', TrainingController::class)->only('index');
    Route::get('/training-details/{id}', function ($id) {
        $training = Training::find($id);
        return view('seller.training-details', ['src' => $training->src]);
    });
    Route::resource('/documents', DocumentController::class)->only('index', 'store', 'destroy');
});

Route::group(["prefix" => "exporter", "as" => "exporter.", 'middleware' => ExporterMiddleware::class], function () {
    Route::get('/', function () {
        return "Welcome Exporter!";
    });
    Route::view('/settings', 'auth.settings');
    Route::resource('/training', TrainingController::class)->only('index');
    Route::get('/training-details/{id}', function ($id) {
        $training = Training::find($id);
        return view('seller.training-details', ['src' => $training->src]);
    });
    Route::resource('/documents', DocumentController::class)->only('index');
});

Route::group(["prefix" => "minicom", "as" => "minicom.", 'middleware' => MinicomMiddleware::class], function () {
    Route::get('/', function () {
        return "Welcom minicom";
    });
    Route::view('/documents', 'minicom.documents');
    Route::get('/users', [ExportersController::class, 'index']);
    Route::get('/users/delete/{id}', [ExportersController::class, 'destroy']);
    Route::get('/users/reject/{id}', [ExportersController::class, 'reject']);
    Route::get('/users/approve/{id}', [ExportersController::class, 'approve']);
    Route::get('/users/sellers', [SellersController::class, 'index']);
    Route::get('/users/sellers/delete/{id}', [SellersController::class, 'destroy']);
    Route::resource('/training', TrainingController::class)->only('index', 'store', 'destroy');
    Route::get('/training-details/{id}', function ($id) {
        $training = Training::find($id);
        return view('minicom.training-details', ['src' => $training->src]);
    });
    Route::view('/products', 'minicom.product.sales');
    Route::view('/products/reporting', 'minicom.product.reporting');
    Route::view('/products/declaration', 'minicom.product.declaration');
    Route::view('/notifications', 'minicom.notifications');
    Route::view('/settings', 'auth.settings');
    Route::resource('/documents', DocumentController::class)->only('index');
    Route::get('/documents/approve/{id}', [DocumentController::class, 'approve']);
    Route::get('/documents/reject/{id}', [DocumentController::class, 'reject']);
});
