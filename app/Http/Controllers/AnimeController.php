<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AnimeController extends Controller{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(){
        $animes = Anime::all();
        return view('anime.anime.index')->with('animes', $animes);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        return view('anime.anime.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required'
            ]);

            $anime = $this->storeAnime($request);
            if(is_null($anime)){
                return Redirect::to('anime/list')->with('error','Ja incluso');
            }

            $tag = $this->storeTag($request);

            if(!is_null($tag)){
                $this->storeAnimesTags($anime, $tag);
            }

            return Redirect::to('anime/list')->with('sucess','Incluido com sucesso');
        }

        private function storeAnime(Request $request){
            $nome = $request->nome;

            $animeExiste = DB::table('animes')->where('nome', $nome)->first();

            if(!is_null($animeExiste)){
                return null;
            }

            $descricao = $request->descricao;
            $ano_lancamento = $request->ano_lancamento;

            $data = [
                'nome' => $nome,
                'descricao' => $descricao,
                'ano_lancamento' => $ano_lancamento
            ];

            $anime = Anime::create($data);
            return Anime::find($anime->id);
        }

        private function storeTag(Request $request){
            $tagNome = $request->tags;

            if(is_null($tagNome)){
                return null;
            }

            $tag = DB::table('tags')->where('nome', $tagNome)->first();

            if(!is_null($tag)){
                return $tag;
            }

            $data = ['nome' => $tagNome];
            Tag::create($data);

            return DB::table('tags')->where('nome', $tagNome)->first();
        }

        private function storeAnimesTags($anime, $tag){
            $idAnime = $anime->id;
            $idTag = $tag->id;

            $relacaoExiste = DB::table('animes_tags')->where([
                ['anime_id', $idAnime],
                ['tag_id', $idTag],
            ])->first();

            if(is_null($relacaoExiste)){
                $anime->tags()->attach($idTag);
                return;
            }
            return;
        }

        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id){
            //
        }

        /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function edit($id){
            //
        }

        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id){
            //
        }

        /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function destroy($id){
            //
        }
    }
