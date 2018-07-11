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

Route::post('/home/guardarVideo','VideoController@guardarVideo');

Route::get('/home/reproducirVideoPiWall','VideoController@reproducirVideoPiWall');
Route::post('/home/reproducirVideoPiWall','VideoController@reproducirVideoPiWall');

Route::get('/home/reproducirVideo','VideoController@reproducirVideo');
Route::post('/home/reproducirVideo','VideoController@reproducirVideo');

Route::get('/home/pararVideo','VideoController@pararVideo');
Route::post('/home/pararVideo','VideoController@pararVideo');

Route::get('/home/reiniciarRaspi','VideoController@reiniciarRaspi');
Route::post('/home/reiniciarRaspi','VideoController@reiniciarRaspi');
