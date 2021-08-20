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
Route::get('qr-code-g', function () {
    QrCode::size(500)->format('png')->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
    return view('qrCode');    
});
Route::prefix('printout')->group(function(){ 
	Route::get('/invoice/{id}'  ,'PrintoutController@invoice');
	Route::get('/manifest/{id}' ,'PrintoutController@manifest');
	Route::get('/awb/{id}'  	,'PrintoutController@awb');
});

Route::prefix('master')->group(function(){ 
		Route::prefix('kota')->group(function(){
			Route::get('/' 				,'Master\KotaController@index');
			Route::get('/create' 		,'Master\KotaController@create');
			Route::get('/edit/{id}'		,'Master\KotaController@edit');
			Route::post('/update'		,'Master\KotaController@update');
			Route::post('/save'			,'Master\KotaController@save');
			Route::post('/delete' 		,'Master\KotaController@delete');
			Route::get('/datatables' 	,'Master\KotaController@datatables');
			Route::post('/gantipassword','Master\KotaController@gantipassword');
			Route::get('/checkusername'	,'Master\KotaController@checkusername');

		});
		Route::prefix('users')->group(function(){
			Route::get('/' 				,'Master\UsersController@index');
			Route::get('/create' 		,'Master\UsersController@create');
			Route::get('/edit/{id}'		,'Master\UsersController@edit');
			Route::post('/update'		,'Master\UsersController@update');
			Route::post('/save'			,'Master\UsersController@save');
			Route::post('/delete' 		,'Master\UsersController@delete');
			Route::get('/datatables' 	,'Master\UsersController@datatables');
			Route::post('/gantipassword','Master\UsersController@gantipassword');
			Route::get('/checkusername'	,'Master\UsersController@checkusername');

		});

		Route::prefix('customer')->group(function(){
			Route::get('/','Master\CustomerController@index');
			Route::get('/create','Master\CustomerController@create');
			Route::get('/edit/{id}','Master\CustomerController@edit');
			Route::post('/update','Master\CustomerController@update');
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


Route::prefix('awb')->group(function(){

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
