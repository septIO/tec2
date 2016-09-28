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
use \Illuminate\Support\Facades;

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
Route::get('update-tracking', function(){
    return view('update-tracking');
})->middleware('role:admin');


Route::post('/tracking/track', 'OrderController@track');
Route::post('/tracking/update', 'UpdateTracking@startTracking')->middleware('auth');
Route::get('/tracking/update/{guid}', 'UpdateTracking@index')->middleware('auth');
Route::post('/tracking/update-items', 'UpdateTracking@store')->middleware('auth');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/tracking/labels/{guid}', 'OrderController@getLabels');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/history', function(){
    return view('orders.history', ['data' => Order::where('a_email', Auth::user()->email)->get()]);
})->middleware('auth');

