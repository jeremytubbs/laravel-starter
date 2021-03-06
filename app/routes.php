<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Home Route
Route::get('/', ['as' => 'home', function() {
    return View::make('home');
}]);

//User Sesions
Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::post('login', ['as' => 'sessions.store', 'uses' => 'SessionsController@store']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);

//User Registration
Route::get('register', ['as' => 'register', 'uses' => 'UsersController@register']);
Route::post('register', ['as' => 'users.store', 'uses' => 'UsersController@store']);

// Password Resets
Route::get('password/reset/{token}', ['as' => 'reset', 'uses' => 'RemindersController@getReset']);
Route::post('password/reset/{token}', 'RemindersController@postReset');
Route::get('remind', ['as' => 'remind', 'uses' => 'RemindersController@getRemind']);
Route::post('remind', 'RemindersController@postRemind');

//Facebook Login
Route::get('facebook/connect', ['as' => 'facebook', 'uses' => 'UsersController@create_facebook']);
Route::get('facebook/login', ['as' => 'store_facebook', 'uses' => 'UsersController@store_facebook']);

//Contact Form
Route::get('contact', ['as' => 'contact', 'uses' => 'ContactController@index']);
Route::post('contact', ['as' => 'contact.send', 'uses' => 'ContactController@send']);

//Posts Show
Route::get('post/{slug}', ['as' => 'post', 'uses' => 'PostsController@show']);

//Admin Area
Route::group(array('before' => 'auth|role:admin', 'prefix' => 'admin'), function() {
    Route::get('', ['as' => 'dashboard', 'uses' => 'AdminController@index']);
    //Users Routes
    Route::resource('users', 'UsersController');
    Route::resource('groups', 'RolesController');
    Route::post('users/create', ['as' => 'addUser', 'uses' => 'UsersController@add']);
    Route::post('assignRole/{id}/{role_id}', 'UsersController@assignRole');
    Route::post('removeRole/{id}/{role_id}', 'UsersController@removeRole');
    //Posts Editor Routes
    Route::resource('posts', 'PostsController', ['only' => ['index', 'update', 'destroy', 'store', 'edit']]);
    Route::get('editor', ['as' => 'editor', 'uses' => 'PostsController@create']);
});

//User Account Activation Email
//Route::get('register/activate/{confirmation}', array('as' => 'users.getConfirm', 'uses' => 'UsersController@getConfirm'));
//Route::post('register/activate/{confirmation}', array('as' => 'users.postConfirm', 'uses' => 'UsersController@postConfirm'));

// Error pages uncomment in production
// App::error(function($exception, $code)
// {
//     switch ($code)
//     {
//         case 403:
//             return Response::view('errors.403', array(), 403);

//         case 404:
//             return Response::view('errors.404', array(), 404);

//         case 500:
//             return Response::view('errors.500', array(), 500);

//         default:
//             return Response::view('errors.default', array(), $code);
//     }
// });