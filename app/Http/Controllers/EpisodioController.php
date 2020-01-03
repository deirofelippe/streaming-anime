<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validacoes\EpisodioValidacao;
use App\Services\EpisodioService;
use Illuminate\Http\Request;

class EpisodioController extends Controller{
    private $service;

    function __construct(){
        $this->service = new EpisodioService();
    }

    public function list($animeId){
        $objs = $this->service->findAll($animeId);

        return view('anime.episodio-list')
        ->with('episodios', $objs['episodios'])
        ->with('anime', $objs['anime']);
    }

    public function form($id){
        $anime = $this->service->findById($id);
        return view('anime.episodio-form')->with('anime', $anime);
    }

    public function add(Request $request){
        $idAnime = $request->anime_id;

        $classeValidacao = new EpisodioValidacao();

        $validacao = $classeValidacao->validar($request);
        if(!is_null($validacao)){
            return redirect()
            ->action('EpisodioController@list', ['idAnime' => $idAnime])
            ->withErrors($validacao);
        }

        $episodio = $this->service->add($request);
        if(!is_null($episodio)){
            $validacao->errors()->add('error','Erro ao cadastrar');

            return redirect()
            ->action('EpisodioController@list', ['idAnime' => $idAnime])
            ->withErrors($validacao);
        }

        return redirect()->action('EpisodioController@list', ['idAnime' => $idAnime]);
    }
}
