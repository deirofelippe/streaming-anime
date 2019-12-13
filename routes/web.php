<?php

Route::get('/', function () {
    return view('home');
});

Route::prefix('anime')->group(function () {
    Route::get('form', 'AnimeController@create');
    Route::get('list', 'AnimeController@index');
    Route::post('', 'AnimeController@store');
});

Route::get('/{id}/episodios', 'EpisodioController@list');
Route::prefix('episodio')->group(function(){
    Route::get('form', 'EpisodioController@infoFormEpisodio');
    Route::get('form/{id}', 'EpisodioController@create');
    Route::post('', 'EpisodioController@store');
});

Route::get('/{id}/embed', 'EmbedController@form');
Route::post('/embed', 'EmbedController@add');
Route::get('/{id}/embeds', 'EmbedController@list');

/*
Route::get('/embed', function ($id) {
    return view('')->with('anime', Anime::find($id));
});

Route::get('/tag', function ($id) {
    return Anime::find($id);
});
*/

Route::get('/fill', 'FillController@fill');
