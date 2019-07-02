<?php

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

Route::get('/', 'PostController@index');

Route::post('/posts/like_add', 'PostController@like_add');
Route::post('/posts/like_destroy', 'PostController@like_destroy');

Route::resource('posts', 'PostController', array(
    'except' => 'index'
));
Route::resource('users', 'UserController', array(
    'except' => array(
        'create',
        'store'
    )
));
Route::resource('comments', 'CommentController', array(
    'except' => array(
        'index',
        'show',
        'create',
        'edit',
        'update'
    )
));

Route::group(['middleware' => ['auth','can:admin']], function(){
    Route::resource('roles', 'RoleController', array(
        'except' => array(
            'create',
            'store',
            'update',
            'edit',
            'update',
            'delete'
        )
    ));
    Route::resource('categories', 'CategoryController');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
