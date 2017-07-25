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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@index')->name('admin');

Route::group(['middleware' => ['auth', 'web']], function() {
    Route::resource('posts', 'PostController');
    Route::resource('categories', 'CategoryController', ['except' => ['show']]);
    Route::resource('subcategories', 'SubcategoryController', ['except' => ['show']]);
    Route::resource('tags', 'TagController', ['except' => ['show', 'edit', 'update']]);
    Route::resource('settings', 'SettingsController', ['except' => ['show']]);
    Route::post('stats/clear', 'HomeController@clearStats');
});

Route::get('/tags/{name}', 'SiteController@tags');
Route::get('/reader/{subcategory}/{currentPost}', 'SiteController@reader');
Route::get('/{category?}/{subcategory?}', 'SiteController@index');
