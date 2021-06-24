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

        // Feature Models
        Route::get('model/list', [FeatureModelController::class, 'list'])->name('researcher.model.list');
        Route::get('model/upload',[FeatureModelController::class,'upload'])->name('researcher.model.upload');
        Route::post('model/upload/p',[FeatureModelController::class,'upload_p'])->name('researcher.model.upload.p');
        Route::post('model/upload/file',[UploadController::class,'process'])->name('researcher.model.upload.file');

        // Communities
        Route::get('community/list',[CommunityController::class,'list'])->name('researcher.community.list');

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

