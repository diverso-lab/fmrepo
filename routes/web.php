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

// Feature Models
Route::get('model/list', [FeatureModelController::class, 'list'])->name('model.list');
Route::get('model/upload',[FeatureModelController::class,'upload'])->name('model.upload');

// Upload dataset
Route::post('model/upload/computer',[FeatureModelController::class,'upload_computer'])->name('model.upload.computer');
Route::post('model/upload/github',[FeatureModelController::class,'upload_github'])->name('model.upload.github');

// Upload and download files from local storage
Route::post('model/upload/file',[UploadController::class,'process'])->name('model.upload.file');
Route::delete('model/upload/file',[UploadController::class,'delete'])->name('model.upload.remove');

// Researcher routes

Route::middleware(['checkroles:RESEARCHER'])->group(function () {
    Route::prefix('researcher')->group(function () {

        // Feature Models




        // Communities
        Route::get('community/list',[CommunityController::class,'list'])->name('community.list');

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

