<?php

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

//Internal Api increate the throttle in server.
Route::middleware('auth:api', 'throttle:500,1')->namespace('Api\internal')->group(function () {
    //Tasks
    Route::resource('internalApi-Todo-List', 'apiDataTodoListController');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
