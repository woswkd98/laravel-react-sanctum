<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

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
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
// user + task + logout을 유저에게만 열고 user의 store는 유저 등록으로 사용할 것
// Auth는 생텀 사용
Route::middleware('auth:sanctum')->group(function() {
    Route::resource('users', 'App\Http\Controllers\UserController', [ 'except'=> ['store']]);
    Route::resource('tasks', 'App\Http\Controllers\TaskController', [ 'except'=> ['index', 'show']]);
    Route::get('tasks/user', 'App\Http\Controllers\TaskController@showByUserId');

    Route::get("logout", 'App\Http\Controllers\LoginController@logout');
    Route::post("files",'App\Http\Controllers\FileController@update');
    Route::get("files/index",'App\Http\Controllers\FileController@getImgIndex');
    Route::get("files/{id}",'App\Http\Controllers\FileController@getImageFromId');
});

Route::post("login", 'App\Http\Controllers\LoginController@login');
Route::post("register", 'App\Http\Controllers\UserController@store');
Route::get('tasks', 'App\Http\Controllers\TaskController@index');
Route::get('tasks/{id}', 'App\Http\Controllers\TaskController@show');
