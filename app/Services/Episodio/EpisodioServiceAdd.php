<?php

namespace App\Services\Episodio;

use App\DAOs\AnimeDAO;
use App\DAOs\EpisodioDAO;
use Exception;
use Illuminate\Support\Facades\Storage;

class EpisodioServiceAdd {
    private $dao;
    private $extensao = '.jpg';

    function __construct(){
        $this->dao = new EpisodioDAO();
    }

    public function add($request){
        $nomeGerado = $this->gerarNome($request);

        try {
            $video = $this->uploadVideo($request, $nomeGerado);
            $thumbnail = $this->uploadThumbnail($request, $nomeGerado, $video);
            $episodio = $this->criarEpisodio($request, $thumbnail, $video);
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->deletarUploads($nomeGerado);
            return null;
        }

        return $episodio;
    }

    private function deletarUploads($nomeGerado){
        Storage::disk('public')->delete("thumbnail/episodio/{$nomeGerado}.jpg");
        Storage::disk('public')->delete("video/{$nomeGerado}.mp4");
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
        $extensao = $request->video->extension();
        $nomeArquivo = "{$nome}.{$extensao}";
        $caminho = 'video';
        $upload = $this->dao->uploadVideo($request, $caminho, $nomeArquivo);

        if(!$upload){
            throw new Exception('Erro ao fazer upload do vídeo');
        }

        return $nomeArquivo;
    }

    private function uploadThumbnail($request, $nome, $video){
        $caminho = 'thumbnail/episodio';

        if(!$request->hasFile('thumbnail')){
            return $this->criarThumbnailPeloFrameDoVideo($video, $caminho);
        }

        $extensao = $request->thumbnail->extension();
        $arquivo = "{$nome}.{$extensao}";
        $upload = $this->dao->uploadThumbnail($request, $caminho, $arquivo);

        if(!$upload){
            throw new Exception('Erro ao fazer upload da thumbnail');
        }

        return $arquivo;
    }

    private function criarThumbnailPeloFrameDoVideo($video, $caminho){
        $nome = explode(".", $video)[0];
        $caminhoComThumbnail = "{$caminho}/{$nome}.jpg";
        $caminhoComVideo = "video/{$video}";
        $disk = 'public';

        $this->dao->criarThumbnailDoVideo($disk, $caminhoComVideo, $caminhoComThumbnail);

        return "{$nome}.jpg";
    }
}
