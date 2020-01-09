<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validacoes\EpisodioValidacao;
use App\Services\Episodio\EpisodioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodioController extends Controller{
    private $service;

    function __construct(){
        $this->service = new EpisodioService();
    }

    public function list($animeId){
        $objs = DB::transaction(function () use ($animeId) {
            return $this->service->findAll($animeId);
       });

        return view('anime.episodio-list')
        ->with('episodios', $objs['episodios'])
        ->with('anime', $objs['anime']);
    }

    public function add(Request $request){
        $animeId = $request->anime_id;

        $classeValidacao = new EpisodioValidacao();

        $validacao = $classeValidacao->validar($request);
        if(!is_null($validacao)){
            return redirect()
            ->action('EpisodioController@list', ['animeId' => $animeId])
            ->withErrors($validacao);
        }

        $episodio = DB::transaction(function () use ($request) {
             return $this->service->add($request);
        });
        if(is_null($episodio)){
            return redirect()
            ->action('EpisodioController@list', ['animeId' => $animeId])
            ->with('error', 'Erro ao cadastrar');
        }

        return redirect()->action('EpisodioController@list', ['animeId' => $animeId]);
    }

    public function findById($animeId, $episodioId){
        $objs = DB::transaction(function ()  use ($animeId, $episodioId){
            return $this->service->findById($animeId, $episodioId);
        });

        return view('anime.episodio')
        ->with('anime', $objs['anime'])
        ->with('episodio', $objs['episodio'])
        ->with('episodios', $objs['episodios']);
    }
}
