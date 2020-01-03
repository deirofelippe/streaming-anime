<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Episodio;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class FillController extends Controller
{
    public function fill(){
        //criar anime
        for($ani = 1;  $ani <= 15; $ani++){
            $data = [
                'nome' => 'Nome '.$ani,
                'thumbnail' => 'Thumbnail '.$ani,
                'descricao' => 'Descrição '.$ani,
                'ano_lancamento' => rand(1980, 2020),
                'views' => rand(1, 10000)
            ];

            $anime = Anime::create($data);
            $idAnime = $anime->id;
            $anime = Anime::find($idAnime);

            //criar tag e relacionar com anime
            $maxTag = rand(5, 10);
            for($ta = 1; $ta <= $maxTag; $ta++){
                $tagNome = 'Tag ' . $ta;
                $tagA = DB::table('tags')->where('nome', $tagNome)->first();
                if(is_null($tagA)){
                    $tag = Tag::create(['nome' => $tagNome]);
                    $anime->tags()->attach($tag->id);
                }
            }

            //criar temporada
            $maxTemp = rand(1, 5);
            for($temp = 1; $temp <= $maxTemp; $temp++){

                //criar episodio p cada temporada
                $maxEpi = rand(1, 12);
                for($epi = 1; $epi <= $maxEpi; $epi++){
                    $data = [
                        'titulo' => 'Titulo '.$epi,
                        'thumbnail' => 'Thumbnail '.$epi,
                        'num_temporada' => $temp,
                        'num_episodio' => $epi,
                        'views' => rand(45, 15000),
                        'anime_id' => $idAnime
                    ];

                    $episodio = Episodio::create($data);
                    $idEpisodio = $episodio->id;
                    $episodio = Episodio::find($idEpisodio);

                    //criar tag e relacionar com episodio
                    $maxTagEpi = DB::table('tags')->count();
                    for($taEpi = 1; $taEpi <= $maxTagEpi; $taEpi++){
                        $tagNome = "Tag " . rand(1, 10);
                        $tag = DB::table('tags')->where('nome', $tagNome)->first();
                        if(!is_null($tag)){
                            $episodio->tags()->attach($tag->id);
                        }
                    }
                }
            }
        }
        return redirect('/');
    }
}
