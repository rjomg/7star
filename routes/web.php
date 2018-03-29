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

#   后台界面
Route::group(['prefix' => '/'], function () {
    Route::get('login', 'Admin\LoginController@index'); //显示后台登录界面
    Route::post('validate','Admin\LoginController@loginHandle'); //登录验证
    Route::post('login', 'Admin\LoginController@login');
    Route::any('logout', 'Admin\LoginController@logout');
});
