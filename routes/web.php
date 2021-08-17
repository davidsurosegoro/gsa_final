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

Route::prefix('popup')->group(function(){
	});


Route::get('/', 'HomeController@index');

Route::prefix('log')->group(function(){

	Route::get('/','LogController@index');
});

Route::prefix('master')->group(function(){
		Route::prefix('customer')->group(function(){
			Route::get('/','Master\CustomerController@index');
			Route::get('/create','Master\CustomerController@create');
			Route::get('/edit/{id}','Master\CustomerController@edit');
			Route::get('/update','Master\CustomerController@update');
			Route::post('/save','Master\CustomerController@save');
			Route::post('/delete','Master\CustomerController@delete');
			Route::get('/datatables','Master\CustomerController@datatables');
		});

		Route::prefix('agen')->group(function(){
			Route::get('/','Master\AgenController@index');
			Route::get('/datatables','Master\AgenController@datatables');
			Route::post('/save','Master\AgenController@save');
			Route::post('/edit','Master\AgenController@edit');
			Route::post('/update','Master\AgenController@update');
			Route::post('/delete','Master\AgenController@delete');
		});
});





Route::prefix('ajax')->group(function(){
});
Route::prefix('cron')->group(function(){
});
Route::prefix('api')->group(function(){
	});


Route::get('/download',function(){
	return view('download');
});
