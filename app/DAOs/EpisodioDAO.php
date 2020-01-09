<?php

namespace App\DAOs;

use App\Models\Anime\Episodio;
use Pbmedia\LaravelFFMpeg\FFMpegFacade;

class EpisodioDAO {

    public function findById($id){
        return Episodio::find($id);
    }

    public function update($data){}

    public function delete($id){}

    public function findByName($nome, $animeId){
        return Episodio::where([
            ['titulo', $nome],
            ['anime_id', $animeId]
            ])->first();
    }

    public function add($data){
        return Episodio::create($data);
    }

    public function findAll($animeId){
        return Episodio::where('anime_id', $animeId)->orderBy('num_episodio','asc')->get();
    }
    public function findByNumeroEpisodio($animeId, $temporada, $episodio){
        return Episodio::where([
            ['num_episodio', $episodio],
            ['num_temporada', $temporada],
            ['anime_id', $animeId]
            ])->first();
    }

    public function uploadThumbnail($request, $caminho, $nomeArquivo){
        return $request->thumbnail->storeAs($caminho, $nomeArquivo, 'public');
    }

    public function uploadVideo($request, $caminho, $nomeArquivo){
        return $request->video->storeAs($caminho, $nomeArquivo, 'public');
    }

    public function criarThumbnailDoVideo($disk, $caminhoComVideo, $caminhoComThumbnail){
        return FFMpegFacade::fromDisk($disk)
        ->open($caminhoComVideo)
        ->getFrameFromSeconds(1)
        ->export()
        ->save($caminhoComThumbnail);
    }
}
