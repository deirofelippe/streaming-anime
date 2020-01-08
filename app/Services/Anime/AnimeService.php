<?php

namespace App\Services\Anime;

use App\DAOs\AnimeDAO;
use App\DAOs\AnimeTagDAO;
use App\DAOs\TagDAO;
use App\Services\InterfaceService;
use Exception;

class AnimeService implements InterfaceService {
    private $dao;

    function __construct(){
        $this->dao = new AnimeDAO();
    }

    public function add($request){
        $thumbnail = uniqid(date('HisYmd'));
        try {
            $upload = $this->fazerUploadDaThumbnail($request, $thumbnail);
            $anime = $this->criarAnime($request, $thumbnail);
            $this->limparTag($request->tags, $anime);
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }

        return $anime;
    }

    private function criarAnime($request, $thumbnail){
        $data = [
            'nome' => $request->nome,
            'thumbnail' => $thumbnail,
            'descricao' => $request->descricao,
            'estudio' => $request->estudio,
            'status' => $request->status,
            'ano_lancamento' => $request->ano_lancamento
        ];

        return $this->dao->add($data);
    }

    private function fazerUploadDaThumbnail($request, $thumbnail){
        if(!$request->hasFile('thumbnail')){
            return null;
        }

        $extensao = $request->thumbnail->extension();
        $nomeArquivo = "{$thumbnail}.{$extensao}";
        $caminho = 'thumbnail/anime';
        $upload = $this->dao->uploadThumbnail($request, $caminho, $nomeArquivo);

        if(!$upload){
            return null;
        }

        return $upload;
    }

    private function limparTag($tags, $anime){
        if(is_null($tags)){
            return;
        }

        $tagArray = explode(",", $tags);
        foreach($tagArray as $tag){
            $tagNome = trim($tag);

            $tagIncluido = $this->criarTag($tagNome);
            $this->criarRelacaoAnimesTags($tagIncluido, $anime);
        }
    }

    private function criarTag($tagNome){
        $tagDAO = new TagDAO();
        $tag = $tagDAO->findByName($tagNome);

        if(!is_null($tag)){
            return $tag;
        }

        return $tagDAO->add($tagNome);
    }

    private function criarRelacaoAnimesTags($tag, $anime){
        $animeTagDAO = new AnimeTagDAO();
        $relacaoExiste = $animeTagDAO->findById($anime->id, $tag->id);

        if(is_null($relacaoExiste)){
            $animeTagDAO->add($anime, $tag->id);
            return;
        }
    }

    public function findAll(){
        return $this->dao->findAll();
    }

    public function findByName($nome){
        return null;
    }
}
