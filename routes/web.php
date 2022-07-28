<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\GuestController@index');

Route::post('/task', 'App\Http\Controllers\GuestController@submitTask');

Route::post('/complete', 'App\Http\Controllers\GuestController@completeTask');

Route::get('/privacypolicy', 'App\Http\Controllers\GuestController@privacyPolicy');

Route::get('/tos', 'App\Http\Controllers\GuestController@tos');
