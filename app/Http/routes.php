<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin', function () {
//    return view('backend');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


Route::group(['namespace' => 'Backend', 'prefix' => 'backend','middleware'=>'api'], function () {

    Route::post('login', 'AuthController@postLogin');
    Route::post('logout', 'AuthController@postLogout');
    Route::post('upload', 'CommonController@upload');

    Route::group(['middleware' => ['jwt_token']], function () {

        Route::get('dashboard', 'DashboardController@index');
        Route::get('admin_info', 'AdminController@getAdminByToken');

        Route::resource('admin', 'AdminController');
        Route::resource('category', 'CategoryController');
        Route::resource('post', 'PostController');
        Route::resource('user', 'UserController');
        Route::resource('tag', 'TagController');
        Route::resource('comment', 'CommentController');

    });

});

