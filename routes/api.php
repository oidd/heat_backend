<?php

use App\Http\Controllers\CollapsibleController;
use App\Http\Controllers\SolderedController;
use App\Models\Soldered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
//    $a = Soldered::create([
//        'brand' => 'a',
//        'model' => 'a',
//        'A' => 'a',
//        'B' => 'a',
//        'C' => 'a',
//        'D' => 'a',
//        'connection' => 'a',
//        'bar' => 'a',
//        'notes' => 'a',
//    ]);
//
//    $a->save();
    return response()->json(Soldered::all());
});

//Route::name('collapsible.')->controller(CollapsibleController::class)->prefix('/collapsible')->group(function () {
//    Route::get('/', 'index');
//    Route::get('/{id}', 'show');
//
//    Route::middleware('isAdmin')->group(function () {
//        Route::post('/', 'store');
//        Route::put('/{id}', 'update');
//        Route::delete('/{id}', 'destroy');
//    });
//});
//
//
//Route::name('soldered.')->controller(SolderedController::class)->prefix('/soldered')->group(function () {
//    Route::get('/', 'index');
//    Route::get('/{id}', 'show');
//
//    Route::middleware('isAdmin')->group(function () {
//        Route::post('/', 'store');
//        Route::put('/{id}', 'update');
//        Route::delete('/{id}', 'destroy');
//    });
//});
