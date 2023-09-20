<?php

use App\Http\Controllers\Data\HardwareReportController;
use App\Http\Controllers\Master\HardwareController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('hardware', [HardwareReportController::class, 'store']);
Route::get('hardware/{hardware}/data/{type}', [HardwareController::class, 'show_data'])->name("api.hardware.data");
