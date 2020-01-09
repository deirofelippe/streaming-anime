<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validacoes\AnimeValidacao;
use App\Services\Anime\AnimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnimeController extends Controller{
    private $service;

    function __construct(){
        $this->service = new AnimeService();
    }

    public function list(){
        $animes = $this->service->findAll();
        return view('anime.anime-list')->with('animes', $animes);
    }

    public function findByName(Request $request){
        $nome = $request->nome;
        if(is_null($nome) || empty($nome)){
            return redirect()->action('AnimeController@list');
        }

        $animes = $this->service->findByName($nome);
        return view('anime.anime-list')->with('animes', $animes);
    }

    public function findById($animeId){
        $objs = DB::transaction(function () use ($animeId) {
            return $this->service->findById($animeId);
        });

        return view('anime.episodio-list')
        ->with('anime', $objs['anime'])
        ->with('episodios', $objs['episodios']);
    }

    public function add(Request $request){

        $animeValidacao = new AnimeValidacao();

        $validacao = $animeValidacao->validar($request);
        if($validacao->fails()){
            return redirect('anime')->withErrors($validacao);
        }

        $anime = DB::transaction(function () use ($request) {
            return $this->service->add($request);
        });
        if(!is_null($anime)){
            $validacao->errors()->add('error','Falha ao cadastrar');
            return redirect()->action('AnimeController@list')->withErrors($validacao);
        }

        $msg = "Cadastrado com sucesso: {$anime->nome}";
        return redirect()->action('AnimeController@list')->with('sucess', $msg);
    }
}
