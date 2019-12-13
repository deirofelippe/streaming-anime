<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episodio;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EpisodioController extends Controller{

    public function list($id){
        return view('anime.episodio-list')->with('anime', Anime::find($id));
    }

    public function create($id){
        return view('anime.episodio-form')->with('anime', Anime::find($id));
    }

    public function infoFormEpisodio(){
        return view('anime.anime-list')->with('info', 'Selecione o nome de um anime para criar episódios');
    }

    public function store(Request $request){
        $request->validate([
            'titulo'=>'required'
        ]);

        $episodio = $this->criarEpisodio($request);
        if(is_null($episodio)){
            return redirect()->action('EpisodioController@list', ['id' => $request->anime_id])->with('error','Dados invalidos');
        }

        $this->executarFuncoesTag($request, $episodio);

        $id = $episodio->id;

        return redirect()->action('EpisodioController@list', ['id' => $id]);
    }

    private function criarEpisodio($request){
        $titulo = $request->titulo;

        $episodioExiste = DB::table('episodios')->where('titulo', $titulo)->first();

        if(!is_null($episodioExiste)){
            //titulo existente
            return null;
        }

        $num_episodio = $request->num_episodio;
        $num_temporada = $request->num_temporada;

        $numeroEhTemporadaExiste = DB::table('episodios')->where([
            ['num_episodio', $num_episodio],
            ['num_temporada', $num_temporada]
        ])->first();

        if(!is_null($numeroEhTemporadaExiste)){
            //episodio e temporada ja existentes
            return null;
        }

        $data = [
            'anime_id' => $request->anime_id,
            'thumbnail' => $request->thumbnail,
            'titulo' => $titulo,
            'num_episodio' => $num_episodio,
            'num_temporada' => $num_temporada
        ];

        $episodio = Episodio::create($data);
        return Episodio::find($episodio->id);
    }

    private function executarFuncoesTag($request, $episodio){
        $tags = $request->tags;
        if(is_null($tags)){
            return;
        }

        $this->limparTag($tags, $episodio);
    }

    private function limparTag($tags, $episodio){
        $tagArray = explode(",", $tags);
        foreach($tagArray as $tag){
            $tagNome = trim($tag);

            $tagIncluido = $this->criarTag($tagNome);
            $this->criarRelacaoEpisodiosTags($tagIncluido, $episodio);
        }
    }

    private function criarTag($tagNome){
        $tag = DB::table('tags')->where('nome', $tagNome)->first();

        if(!is_null($tag)){
            return $tag;
        }

        $data = ['nome' => $tagNome];
        return Tag::create($data);
    }

    private function criarRelacaoEpisodiosTags($tag, $episodio){
        if(is_null($tag)){
            return;
        }

        $idEpisodio = $episodio->id;
        $idTag = $tag->id;

        $relacaoExiste = DB::table('episodios_tags')->where([
            ['episodio_id', $idEpisodio],
            ['tag_id', $idTag],
        ])->first();

        if(is_null($relacaoExiste)){
            $episodio->tags()->attach($idTag);
            return;
        }
    }

    public function show($id){
    }

    public function edit($id){
    }

    public function update(Request $request, $id){
    }

    public function destroy($id){
    }
}
