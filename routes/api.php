<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollapsibleController;
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

//Route::get('/ttt', function () {
//   for ($i = 0; $i < 100; $i++)
//   {
//       DB::table('soldered')->insert([
//           'Brand' => Str::random(10),
//           'Model' => Str::random(10),
//           'HC' => rand(3, 10) / 5,
//           'VC' => rand(3, 10) / 5,
//           'width' => rand(3, 10) / 5,
//           'height' => rand(3, 10) / 5,
//           'Connection' => Str::random(10),
//           'Bar' => Str::random(10),
//           'Notes' => Str::random(10),
//       ]);
//
//       DB::table('collapsible')->insert([
//           'Brand' => Str::random(10),
//           'Model' => Str::random(10),
//           'HC' => rand(3, 10) / 5,
//           'VC' => rand(3, 10) / 5,
//           'width' => rand(3, 10) / 5,
//           'height' => rand(3, 10) / 5,
//           'DU' => rand(3, 10) / 5,
//           'Notes' => Str::random(10),
//       ]);
//   }
//});

Route::post('/login', [AuthController::class, 'login']);

Route::name('collapsible.')->controller(CollapsibleController::class)->prefix('/collapsible')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');

    Route::middleware('isAdmin')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});


Route::name('soldered.')->controller(SolderedController::class)->prefix('/soldered')->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');

    Route::middleware('isAdmin')->group(function () {
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
});
