<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Categories\CategoriesListController;
use App\Http\Controllers\Tasks\TasksDeleteController;
use App\Http\Controllers\Tasks\TasksListController;
use App\Http\Controllers\Tasks\TasksStoreController;
use App\Http\Controllers\Tasks\TasksUpdateController;
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

/***************************************************************************************************
 * â–‚ â–ƒ â–… â–† â–ˆ  Authentication  â–ˆ â–† â–… â–ƒ â–‚
 ***************************************************************************************************/
Route::group(['prefix'=>'v1'], function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);


    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', [AuthController::class, 'logout']);

        Route::get('categories', CategoriesListController::class);

        Route::post('tasks/store',TasksStoreController::class);
        Route::get('tasks', TasksListController::class);
        Route::patch('tasks/update',TasksUpdateController::class);
        Route::post('tasks/destroy',TasksDeleteController::class);
    });

});
