<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

// Register researcher and developer
Route::prefix('register')->group(function () {

    Route::get('researcher', [RegisterResearcherController::class, 'register'])->name('register.researcher');
    Route::post('researcher/p', [RegisterResearcherController::class, 'register_p'])->name('register.researcher.p');

    Route::get('developer', [RegisterDeveloperController::class, 'register'])->name('register.developer');
    Route::post('developer/p', [RegisterDeveloperController::class, 'register_p'])->name('register.developer.p');
});


// Researcher routes

Route::middleware(['checkroles:RESEARCHER'])->group(function () {
    Route::prefix('researcher')->group(function () {

        // Zenodo token
        Route::get('zenodo/token', [ResearcherController::class, 'zenodo_token'])->name('researcher.zenodo.token');
        Route::post('zenodo/token/p', [ResearcherController::class, 'zenodo_token_p'])->name('researcher.zenodo.token.p');

        // Depositions
            // API
        Route::get('deposition/api/load', [DepositionController::class, 'load'])->name('researcher.deposition.api.load');
        Route::get('deposition/list', [DepositionController::class, 'list'])->name('researcher.deposition.list');

        // Models
        Route::get('model/upload',[FeatureModelController::class,'upload'])->name('researcher.model.upload');
        Route::post('model/upload/p',[FeatureModelController::class,'upload_p'])->name('researcher.model.upload.p');
        Route::post('model/upload/file',[UploadController::class,'process'])->name('researcher.model.upload.file');


    });
});


// Developer routes

Route::middleware(['checkroles:DEVELOPER'])->group(function () {
    Route::prefix('developer')->group(function () {

        // API token
        Route::get('token/get', [DeveloperController::class, 'get_token'])->name('developer.token.get');

    });
});

Auth::routes();

