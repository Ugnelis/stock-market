<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('login', 'AuthenticateController@login');
    Route::post('register', 'AuthenticateController@register');

    Route::get('stocks', 'StockController@index');
    Route::get('stocks/{symbol}', 'StockController@show');
    Route::get('stocks/{symbol}/history', 'StockController@history');
    Route::get('stocks/{symbol}/transactions', 'StockController@transactions');
    Route::get('stocks/{symbol}/orders', 'StockController@orders');

    Route::get('pages', 'PageController@index');
    Route::get('pages/{uri}', 'PageController@show');
    Route::post('pages', 'PageController@store');
    Route::put('pages/{id}', 'PageController@update');
    Route::delete('pages/{id}', 'PageController@remove');

    Route::get('users', 'UserController@index');
    Route::delete('users/{id}', 'UserController@remove');

    Route::get('profile', 'ProfileController@index');
    Route::get('profile/inventory', 'ProfileController@inventory');
    Route::get('profile/account', 'ProfileController@account');
    Route::get('profile/orders', 'ProfileController@orders');

    Route::get('orders', 'OrderController@index');
    Route::post('orders', 'OrderController@submit');
    Route::delete('orders/{id}', 'OrderController@remove');

    Route::get('notifications', 'NotificationController@index');
    Route::post('notifications', 'NotificationController@submit');
    Route::delete('notifications/{id}', 'NotificationController@remove');
});
