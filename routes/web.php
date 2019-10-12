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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'page', 'middleware' => 'auth'], function() {
    Route::get('/create', 'Admin\PageController@add');
    Route::post('/create', 'Admin\PageController@create');
    Route::get('/edit', 'Admin\PageController@edit');
    Route::post('/edit', 'Admin\PageController@update');
    Route::get('/delete', 'Admin\PageController@delete');
});

Route::group(['prefix' => 'userpage', 'middleware' => 'auth'], function() {
    Route::get('/mypage', 'Mypage\MypageController@index');
    Route::get('/profile/edit', 'Mypage\MypageController@profileEdit');
    Route::post('/profile/edit', 'Mypage\MypageController@profileUpdate');
    Route::get('/pages', 'Mypage\MypageController@pagelist');
    
});