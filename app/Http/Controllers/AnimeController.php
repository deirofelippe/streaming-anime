<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validacoes\AnimeValidacao;
use App\Services\Anime\AnimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AnimeController extends Controller{
    private $service;

    function __construct(){
        $this->service = new AnimeService();
    }

    public function list(){
        $animes = $this->service->findAll();
        return view('anime.anime-list')->with('animes', $animes);
    }

    public function listByNome($nome){
        if(is_null($nome) || empty($nome)){
            return redirect()->action('AnimeController@listByNome');
        }

        $animes = $this->service->findByName($nome);
        return view('anime.anime-list')->with('animes', $animes);
    }

    public function form(){
        return view('anime.anime-form');
    }

    public function add(Request $request){

        $animeValidacao = new AnimeValidacao();

        $validacao = $animeValidacao->validar($request);
        if($validacao->fails()){
            return redirect('anime/form')->withErrors($validacao);
        }

        $anime = DB::transaction(function () use ($request) {
            return $this->service->add($request);
        });
        if(!is_null($anime)){
            $validacao->errors()->add('error','Falha ao cadastrar');
            return redirect('anime/form')->withErrors($validacao);
        }

        $msg = "Cadastrado com sucesso: {$anime->nome}";
        return Redirect::to('anime')->with('sucess', $msg);
    }
}
