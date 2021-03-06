<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

// FRONT ROUTES
/*
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('login', function () {
   return view('welcome');
})->name('login');
 */


// BACK ROUTES
// Uses Auth Middleware
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index');
    
    Route::get('/swagger', 'HomeController@loadSwagger');
    
    Route::get('/swagger/index', 'SwaggerController@load');
    Route::get('/swagger/profile', 'SwaggerController@index');
    Route::get('/swagger/projects', 'SwaggerController@show');
    
    Route::get('/project', 'ProjectController@form');
    
    Route::resource('/txProjects', 'txProjectController');
    Route::post('/txProjects/store', 'txProjectController@store');
    Route::get('/txProjects/create', 'txProjectController@create');
    
    Route::resource('/weather', 'ApixuController');
    
    /**
    Route::get('user/profile', function () {
        return view('/user/profile');
    });
     */
});

