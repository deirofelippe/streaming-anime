<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Validacoes\AnimeValidacao;
use App\Services\Anime\AnimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AnimeController extends Controller{
    //pegar primeiro frame do video pra thumbnail
    //usar api de pagamento
    //security (auth, email confirmation, reset password)
    //autocomplete na pesquisa
    //player javascript video
    //
    //google analytics
    //juntar tds os css usados com o principal, de acordo com cada pagina

    //grava o id, o retorno dos petodos sempre serao msg de erro ou n. o retorno do obj incluido no bd sera trocado pela busca dele no final de tds as validacoes
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
        if($validacao->fails() || $validacao->errors()->isNotEmpty()){
            //erro na validacao, validacao manual n é exibida na view
            return redirect('anime/form')->withErrors($validacao);
        }

        $anime = $this->service->add($request);
        if(!is_null($anime)){
            $validacao->errors()->add('error','Falha ao cadastrar');
            return redirect('anime/form')->withErrors($validacao);
        }

        $msg = "Cadastrado com sucesso: {$anime->nome}";
        return Redirect::to('anime')->with('sucess', $msg);
    }
}
