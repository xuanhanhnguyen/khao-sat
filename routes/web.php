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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/khao-sat', 'KhaoSatController@index');
    Route::get('/cau-hoi', 'CauHoiController@index');
    Route::get('/ket-qua', 'KetQuaController@index');
});

Route::group(['namespace' => 'Theme'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/{slug}.html', 'DetailController@index')->name('detail');
    Route::post('/{slug}.html', 'SurveyController@index')->name('survey');
    Route::post('/save', 'SurveyController@save')->name('save');
});