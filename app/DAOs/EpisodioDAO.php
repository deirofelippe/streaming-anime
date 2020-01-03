<?php

namespace App\DAOs;

use App\Models\Anime\Episodio;

class EpisodioDAO {

    public function findById($id){
        return Episodio::find($id);
    }

    public function update($data){}

    public function delete($id){}

    public function findByName($name){
        return Episodio::where('titulo', $name)->first();
    }

    public function add($data){
        return Episodio::create($data);
    }

    public function findAll($animeId){
        return Episodio::where('anime_id', $animeId)->orderBy('num_episodio','desc')->get();
    }
    public function findByNumeroEpisodio($request){
        return Episodio::where([
            ['num_episodio', $request->num_episodio],
            ['num_temporada', $request->num_temporada]
            ])->first();
    }

    public function uploadThumbnail($request, $caminho, $nomeArquivo){
        return $request->thumbnail->storeAs($caminho, $nomeArquivo, 'public');
    }

    public function uploadVideo($request, $caminho, $nomeArquivo){
        return $request->video->storeAs($caminho, $nomeArquivo, 'public');
    }
}
