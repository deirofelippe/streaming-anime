<?php

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index');

Route::get('/anime/form', 'AnimeController@create');
Route::get('/anime/list', 'AnimeController@index');
Route::post('/anime/add', 'AnimeController@store');

// Route::
