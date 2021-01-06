<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'dashboard', 'namespace' => 'Admin', 'middleware' => 'guest'], function () {
    Route::resource('/', 'DashboardController');
    Route::resource('khao-sat', 'KhaoSatController');
    Route::resource('cau-hoi', 'CauHoiController');
    Route::resource('ket-qua', 'KetQuaController');
    Route::resource('tai-khoan', 'TaiKhoanController');
});

Route::group(['namespace' => 'Theme'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/{slug}.html', 'DetailController@index')->name('detail');
    Route::post('/{slug}.html', 'SurveyController@index')->name('survey');
    Route::post('/save', 'SurveyController@save')->name('save');
});