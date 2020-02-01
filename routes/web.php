<?php

Route::get('/', function () {
    return view('home');
});

Route::prefix('anime')->group(function () {
    // Route::get('form', 'AnimeController@form');
    Route::get('buscar', 'AnimeController@findByName');
    // Route::get('{animeId}', 'AnimeController@findById');
    Route::get('', 'AnimeController@list');
    Route::post('', 'AnimeController@add');

    Route::get('{animeId}/episodios', 'EpisodioController@list');
    Route::prefix('{animeId}/episodio')->group(function(){
        // Route::get('form', 'EpisodioController@form');
        Route::get('{episodioId}', 'EpisodioController@findById');
        Route::post('', 'EpisodioController@add');
    });
});

Route::get('/users', 'UserGetController@list')->middleware('temPermissao:admin');
// Route::prefix('/user')->group(function () {
//     Route::get('{userUsername}', 'UserController@findByUsername');
// });

/*
Route::get('/embed', function ($id) {
    return view('')->with('anime', Anime::find($id));
});

Route::get('/tag', function ($id) {
    return Anime::find($id);
});
*/

/*
design: perto do final e usando js, ajax e json
inclusao junto com listagem
inclusao dinamica q pode ser com array em json, de animes ou episodios
edicao na mesma pagina de mostrar (mostrar um episodio, tds ou mostrar o anime)

js: ajax, json,
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
