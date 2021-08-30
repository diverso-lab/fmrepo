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

Route::prefix('dataset')->group(function () {

    // Dataset
    Route::get('view/{id}', [DatasetController::class, 'view'])->name('dataset.view');
    Route::get('list', [DatasetController::class, 'list'])->name('dataset.list');

    // Upload dataset
    Route::prefix('upload')->group(function () {
        Route::get('',[DatasetController::class,'upload'])->name('dataset.upload');
        Route::post('computer',[DatasetController::class,'upload_computer'])->name('dataset.upload.computer');
        Route::post('github',[DatasetController::class,'upload_github'])->name('dataset.upload.github');
        Route::post('zip',[DatasetController::class,'upload_zip'])->name('dataset.upload.zip');
        Route::post('textplain',[DatasetController::class,'upload_textplain'])->name('dataset.upload.textplain');

        // Upload and download files from local storage
        Route::post('file',[UploadController::class,'process'])->name('dataset.upload.file');
        Route::delete('file',[UploadController::class,'delete'])->name('dataset.upload.remove');

    });

});

Route::prefix('community')->group(function () {
    // Communities
    Route::get('list',[CommunityController::class,'list'])->name('community.list');
    Route::get('view/{id}',[CommunityController::class,'view'])->name('community.view');
});

// Researcher routes
Route::middleware(['checkroles:RESEARCHER'])->group(function () {
    Route::prefix('researcher')->group(function () {

        // Datasets
        Route::get('dataset/mine',[DatasetController::class,'mine'])->name('dataset.mine');

        // Communities
        Route::prefix('community')->group(function () {
            Route::get('create',[CommunityController::class,'create'])->name('community.create');
            Route::post('create/p',[CommunityController::class,'create_p'])->name('community.create.p');
            Route::get('mine',[CommunityController::class,'mine'])->name('community.mine');
            Route::get('join/{id}',[CommunityController::class,'join'])->name('community.join');
            Route::get('{id}/dataset/add',[CommunityController::class,'dataset_add'])->name('researcher.community.dataset.add');
            Route::post('dataset/add',[CommunityController::class,'dataset_add_p'])->name('researcher.community.dataset.add_p');
        });

    });
});

// Developer routes

Route::middleware(['checkroles:DEVELOPER'])->group(function () {
    Route::prefix('developer')->group(function () {

        // API token
        Route::get('token/get', [DeveloperController::class, 'get_token'])->name('developer.token.get');

    });
});

// Reviewer routes

Route::middleware(['checkroles:REVIEWER'])->group(function () {
    Route::prefix('reviewer')->group(function () {

        Route::prefix('review')->group(function () {
            Route::get('request', [ReviewController::class, 'list'])->name('reviewer.review.request');
            Route::get('request/verificate/{request_id}', [ReviewController::class, 'verificate'])->name('reviewer.review.request.verificate');
            Route::post('request/verificate_p', [ReviewController::class, 'verificate_p'])->name('reviewer.review.request.verificate_p');
        });



    });
});



Auth::routes();

