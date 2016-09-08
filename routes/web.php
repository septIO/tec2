<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use \Illuminate\Http\Request;
use \App\Order;
use \App\Http\Requests;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/order', 'OrderController@index');
Route::post('/order/create', 'OrderController@store');
Route::get('/order/show/{id}', 'OrderController@show');

Route::get('/help', function () {
    return view('help');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/tracking', function(){
    return view('tracking');
});

Route::post('/tracking/track', 'OrderController@track');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index');