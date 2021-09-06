<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('datasets', [APIController::class, 'dataset_list'])->name('api.dataset.list');
Route::get('datasets/{id}', [APIController::class, 'dataset_get'])->name('api.dataset.get');

Route::get('datasets/{id}/files', [APIController::class, 'dataset_files'])->name('api.dataset.files.list');

Route::get('communities', [APIController::class, 'communities_list'])->name('api.dataset.communities');
Route::get('communities/{id}', [APIController::class, 'community_get'])->name('api.communities.get');
Route::get('communities/{id}/members', [APIController::class, 'community_members'])->name('api.communities.members');
Route::get('communities/{id}/admins', [APIController::class, 'community_admins'])->name('api.communities.admins');
Route::get('communities/{id}/datasets', [APIController::class, 'community_datasets'])->name('api.communities.datasets');