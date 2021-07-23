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

// Dataset
Route::get('dataset/view/{id}', [DatasetController::class, 'view'])->name('dataset.view');
Route::get('dataset/list', [DatasetController::class, 'list'])->name('dataset.list');
Route::get('dataset/upload',[DatasetController::class,'upload'])->name('dataset.upload');

// Upload dataset
Route::post('dataset/upload/computer',[DatasetController::class,'upload_computer'])->name('dataset.upload.computer');
Route::post('dataset/upload/github',[DatasetController::class,'upload_github'])->name('dataset.upload.github');
Route::post('dataset/upload/zip',[DatasetController::class,'upload_zip'])->name('dataset.upload.zip');
Route::post('dataset/upload/textplain',[DatasetController::class,'upload_textplain'])->name('dataset.upload.textplain');

// Upload and download files from local storage
Route::post('dataset/upload/file',[UploadController::class,'process'])->name('dataset.upload.file');
Route::delete('dataset/upload/file',[UploadController::class,'delete'])->name('dataset.upload.remove');

// Researcher routes

Route::middleware(['checkroles:RESEARCHER'])->group(function () {
    Route::prefix('researcher')->group(function () {

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

// Reviewer routes

Route::middleware(['checkroles:REVIEWER'])->group(function () {
    Route::prefix('reviewer')->group(function () {

        Route::get('review/request', [ReviewController::class, 'list'])->name('reviewer.review.request');
        Route::get('review/request/verificate/{request_id}', [ReviewController::class, 'verificate'])->name('reviewer.review.request.verificate');
        Route::post('review/request/verificate_p', [ReviewController::class, 'verificate_p'])->name('reviewer.review.request.verificate_p');


    });
});



Auth::routes();

