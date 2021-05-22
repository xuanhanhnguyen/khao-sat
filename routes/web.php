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
    Route::resource('nhom', 'NhomController');
    Route::resource('join-group', 'JoinGroupController');
    Route::get('join-group/{group}/{id}', 'JoinGroupController@pheduyet');
    Route::post('/nhom/them-thanh-vien/{id}', 'NhomController@addThanhVien')->name('nhom.add');
});

Route::group(['namespace' => 'Theme'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/{slug}.html', 'DetailController@index')->name('detail');
    Route::post('/{slug}.html', 'SurveyController@index')->name('survey');
    Route::post('/save', 'SurveyController@save')->name('save');
    Route::get('/nhom', 'GroupController@index')->name('nhom');
    Route::get('/nhom/{id}', 'GroupController@show')->name('nhom.detail');
    Route::post('/nhom/{id}', 'GroupController@join')->name('nhom.join');
});