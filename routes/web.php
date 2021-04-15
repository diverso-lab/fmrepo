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

// Register
Route::get('register/researcher', [RegisterResearcherController::class, 'register'])->name('register.researcher');
Route::post('register/researcher/p', [RegisterResearcherController::class, 'register_p'])->name('register.researcher.p');

// Researcher routes


Route::prefix('researcher')->group(function () {

    Route::middleware(['checkroles:RESEARCHER'])->group(function () {
        Route::get('zenodo/token', [ResearcherController::class, 'zenodo_token'])->name('researcher.zenodo.token');
        Route::post('zenodo/token/p', [ResearcherController::class, 'zenodo_token_p'])->name('researcher.zenodo.token.p');
    });



});

// Developer routes

Route::get('/prueba', [PruebaController::class, 'prueba'])->name('prueba');

Auth::routes();

