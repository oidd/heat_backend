<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollapsibleController;
use App\Http\Controllers\DtseriesController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OrseriesController;
use App\Http\Controllers\SolderedController;
use App\Models\Soldered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('isAdmin')->group(function () {
    Route::post('/upload', [FileController::class, 'upload']);
    Route::post('/deleteFile', [FileController::class, 'delete']);
});

Route::name('collapsible.')->controller(CollapsibleController::class)->prefix('/collapsible')->group(function () {
    Route::get('/{id}', 'show');
    Route::get('/', 'index');

    Route::middleware('isAdmin')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});

Route::name('soldered.')->controller(SolderedController::class)->prefix('/soldered')->group(function () {
    Route::get('/{id}', 'show');
    Route::get('/', 'index');

    Route::middleware('isAdmin')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});

Route::name('dtseries.')->controller(DtseriesController::class)->prefix('/dtseries')->group(function () {
    Route::get('/{id}', 'show');
    Route::get('/', 'index');

    Route::middleware('isAdmin')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});

Route::name('orseries.')->controller(OrseriesController::class)->prefix('/orseries')->group(function () {
    Route::get('/{id}', 'show');
    Route::get('/', 'index');

    Route::middleware('isAdmin')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});
