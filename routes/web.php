<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeclarationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ExportersController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\ShipmentController;
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
    Route::resource('/products', ProductController::class)->only('index', 'store', 'destroy');

    Route::resource('/products/sales', SaleController::class)->only('index', 'store');
    Route::get('/products/shipment', [ShipmentController::class, 'index']);
    Route::get('products/shipment/{id}', [ShipmentController::class, 'pendingPay']);
    Route::view('/products/reporting', 'seller.product.reporting');
    Route::get('/products/declaration', [DeclarationController::class, 'index']);
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
    Route::resource('/products', ShipmentController::class)->only('index', 'store');
    Route::resource('/products/declaration', DeclarationController::class)->only('index', 'store');
    Route::get('/products/declaration/ship/{id}', [DeclarationController::class, 'confirmShip']);
    Route::get('/products/declaration/delivered/{id}', [DeclarationController::class, 'confirmDelivered']);
    Route::view('/products/reporting', 'exporter.product.reporting');
    Route::get('products/approve-payment/{id}', [ShipmentController::class, 'approvePay']);
});

Route::group(["prefix" => "minicom", "as" => "minicom.", 'middleware' => MinicomMiddleware::class], function () {
    Route::get('/', function () {
        return "Welcom minicom";
    });
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
    Route::get('/products', [SaleController::class, 'index']);
    Route::post('/products/report', [SaleController::class, 'report']);
    Route::view('/products/reporting', 'minicom.product.reporting');
    Route::get('/products/declaration', [DeclarationController::class, 'index']);
    Route::post('/products/declaration/report', [DeclarationController::class, 'report']);
    Route::get('/products/shipment', [ShipmentController::class, 'index']);
    Route::post('/products/shipment/report', [ShipmentController::class, 'report']);
    Route::view('/settings', 'auth.settings');
    Route::resource('/documents', DocumentController::class)->only('index');
    Route::get('/documents/approve/{id}', [DocumentController::class, 'approve']);
    Route::post('/documents/reject/{id}', [DocumentController::class, 'reject']);
});
