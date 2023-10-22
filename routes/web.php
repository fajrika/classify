<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Data\HardwareReportController;
use App\Http\Controllers\Data\PlantDataTrainingController;
use App\Http\Controllers\Master\HardwareController;
use App\Http\Controllers\Master\MappingController;
use App\Http\Controllers\Master\PlantController;
use App\Http\Controllers\Master\PlantHardwareController;
use App\Models\Hardware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return '<a href="https://api.notion.com/v1/oauth/authorize?client_id=c4cb8c89-2a4f-4ad8-ba44-1669ffd0c3d5&response_type=code&owner=user&redirect_uri=https%3A%2F%2Fclassify.test%2F">Add to Notion</a>';
    return view('pages.dashboard');
});


Route::resource('dashboard', DashboardController::class);

Route::as('master.')->prefix('/master')->group(function () {
    Route::resource('plant', PlantController::class);
    Route::resource('plant', PlantController::class);
    Route::resource('hardware', HardwareController::class);
});
Route::as('data.')->prefix('/data')->group(function () {
    Route::resource('plant', PlantDataTrainingController::class);
    Route::get('plant/{plant}/generate', [PlantDataTrainingController::class, 'generate'])->name('plant.generate.create');
    Route::put('plant/{plant}/generate', [PlantDataTrainingController::class, 'updateGenerate'])->name('plant.generate.update');
    
    Route::get('plant/{plant}/manual', [PlantDataTrainingController::class, 'manual'])->name('plant.manual.create');
    Route::put('plant/{plant}/manual', [PlantDataTrainingController::class, 'updateManual'])->name('plant.manual.update');
    Route::resource('hardware', HardwareReportController::class);
});
