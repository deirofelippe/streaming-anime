<?php

Route::get('/', function () {
    return view('home');
});

Route::prefix('anime')->group(function () {
    Route::get('form', 'AnimeController@form');
    Route::get('{idAnime}', 'AnimeController@find');
    Route::get('', 'AnimeController@list');
    Route::post('', 'AnimeController@add');

    Route::get('{idAnime}/episodio', 'EpisodioController@list');
    Route::prefix('{idAnime}/episodio')->group(function(){
        Route::get('form', 'EpisodioController@form');
        Route::get('{idEpisodio}', 'EpisodioController@find');
        Route::post('', 'EpisodioController@add');
    });
});

/*
Route::get('/embed', function ($id) {
    return view('')->with('anime', Anime::find($id));
});

Route::get('/tag', function ($id) {
    return Anime::find($id);
});
*/

Route::get('/fill', 'FillController@fill');

/*
design: perto do final e usando js, ajax e json
inclusao junto com listagem
inclusao dinamica q pode ser com array em json, de animes ou episodios
edicao na mesma pagina de mostrar (mostrar um episodio, tds ou mostrar o anime)

js: ajax, json,
*/
