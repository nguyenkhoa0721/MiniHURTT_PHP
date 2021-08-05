<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\repoController;
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

Route::get('repo',[repoController::class, 'all']);
Route::get('repo/{id}', [repoController::class, 'detail']);
Route::post('repo', [repoController::class, 'create']);
Route::put('repo/{id}', [repoController::class, 'update']);
Route::delete('repo/{id}', [repoController::class, 'delete']);

