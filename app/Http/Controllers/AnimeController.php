<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AnimeController extends Controller{

    public function index(){
        $animes = Anime::all();
        return view('anime.anime-list')->with('animes', $animes);
    }

    public function create(){
        return view('anime.anime-form');
    }

    public function store(Request $request){
        $request->validate([
            'nome' => 'required'
            ]);

            $anime = $this->criarAnime($request);
            if(is_null($anime)){
                return Redirect::to('anime/list')->with('info','Ja incluso');
            }

            $this->executarFuncoesTag($request, $anime);

            return Redirect::to('anime/list')->with('sucess','Incluido com sucesso');
        }

        private function criarAnime($request){
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

        private function executarFuncoesTag($request, $anime){
            $tags = $request->tags;
            if(is_null($tags)){
                return;
            }

            $this->limparTag($tags, $anime);
        }

        private function limparTag($tags, $anime){
            $tagArray = explode(",", $tags);
            foreach($tagArray as $tag){
                $tagNome = trim($tag);

                $tagIncluido = $this->criarTag($tagNome);
                $this->criarRelacaoAnimesTags($tagIncluido, $anime);
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

        private function criarRelacaoAnimesTags($tag, $anime){
            if(is_null($tag)){
                return;
            }

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
