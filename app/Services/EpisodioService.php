<?php

namespace App\Services;

use App\DAOs\AnimeDAO;
use App\DAOs\EpisodioDAO;
use Exception;

class EpisodioService implements InterfaceService {
    private $dao;

    function __construct(){
        $this->dao = new EpisodioDAO();
    }

    public function add($request){
        $nomeGerado = $this->gerarNome($request);

        try {
            $thumbnail = $this->uploadThumbnail($request, $nomeGerado);
            $video = $this->uploadVideo($request, $nomeGerado);
            $episodio = $this->criarEpisodio($request, $thumbnail, $video);
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }

        return $episodio;
    }

    private function gerarNome($request){
        $animeDAO = new AnimeDAO();
        $anime = $animeDAO->findById($request->anime_id);

        $nomeAnime = $anime->nome;
        $temporada = $request->num_temporada;
        $episodio = $request->num_episodio;

        return "{$nomeAnime}-temp-{$temporada}-ep-{$episodio}";
    }

    private function criarEpisodio($request, $thumbnail, $video){
        $data = [
            'anime_id' => $request->anime_id,
            'thumbnail' => $thumbnail,
            'titulo' => $request->titulo,
            'num_episodio' => $request->num_episodio,
            'num_temporada' => $request->num_temporada,
            'video' => $video
        ];

        $episodio = $this->dao->add($data);

        return $episodio;
    }

    private function uploadVideo($request, $nome){
        if(!$request->hasFile('video')){
            return null;
        }

        $extensao = $request->video->extension();
        $nomeArquivo = "{$nome}.{$extensao}";
        $caminho = 'video';
        $upload = $this->dao->uploadVideo($caminho, $nomeArquivo, 'public');

        if(!$upload){
            return null;
        }

        return $nomeArquivo;
    }

    private function uploadThumbnail($request, $nome){
        //se thumb estiver vazia, pega o primeiro frame do video
        if(!$request->hasFile('thumbnail')){
            return null;
        }

        $extensao = $request->thumbnail->extension();
        $nomeArquivo = "{$nome}.{$extensao}";
        $caminho = 'thumbnail/episodio';
        $upload = $this->dao->uploadThumbnail($caminho, $nomeArquivo, 'public');

        if(!$upload){
            return null;
        }

        return $nomeArquivo;
    }

    public function findById($id){
        return $this->dao->findById($id);
    }

    public function findAll($animeId){
        $episodios = $this->dao->findAll($animeId);

        $animeDAO = new AnimeDAO();
        $anime = $animeDAO->findById($animeId);

        return [
            'episodios' => $episodios,
            'anime' => $anime
        ];
    }
}
