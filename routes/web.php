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

#   前台界面
Route::group(['prefix' => '/'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

#   后台界面
Route::group(['prefix' => 'admin'], function () {
    Route::get('code', 'admin\LoginController@code');//后台验证码
    //用户登录验证
    Route::get('login', 'admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'admin\LoginController@login');
    Route::any('logout', 'admin\LoginController@logout');
});
