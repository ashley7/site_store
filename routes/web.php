<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {  

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('users','UserController');

    Route::resource('items','ItemController');

    Route::resource('stores','StoreController');

    Route::resource('stock','StockController');  

    Route::resource('issue_stock','IssueController');    

    Route::resource('reports','ReportController');    

});


