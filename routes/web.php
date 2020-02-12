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

Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/home/create/page_1', 'DashboardController@create')->name('create_page_1');
Route::get('/home/create/page_2/{id}', 'DashboardController@showSecondPage')->name('create_page_2');
Route::get('/home/create/page_1/{id}', 'DashboardController@show')->name('show_to_continue_enter');
Route::get('/models_for_maker/{maker_id}','ModelsController@getModelForMaker');
Route::post('/home/create/page_1/{id}', 'DashboardController@update')->name('first_page_save');
Route::post('/home/create/page_2/{id}', 'DashboardController@updateWithPhoto')->name('first_page_save');
Route::delete('/home/{id}', 'DashboardController@destroy')->name('delete_case');