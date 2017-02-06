<?php

use Illuminate\Http\Request;

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
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
*/

Auth::routes();

// TASK ROUTES
// get list of tasks
Route::get('tasks','TaskController@index');
// get specific task
Route::get('task/{id}','TaskController@show');
// delete a task
Route::delete('task/{id}','TaskController@destroy');
// update existing task
Route::put('task','TaskController@store');
// create new task
Route::post('task','TaskController@store');

// PROJECT ROUTES
// get list of projects
Route::get('projects','ProjectController@index');
// get specific project
Route::get('project/{id}','ProjectController@show');
// delete a project
Route::delete('project/{id}','ProjectController@destroy');
// update existing project
Route::put('project','ProjectController@store');
// create new project
Route::post('project','ProjectController@store');