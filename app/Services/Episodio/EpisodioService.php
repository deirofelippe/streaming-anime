<?php

namespace App\Services\Episodio;

use App\DAOs\AnimeDAO;
use App\DAOs\EpisodioDAO;
use App\Services\Episodio\EpisodioServiceAdd;
use App\Services\InterfaceService;
use Exception;

class EpisodioService implements InterfaceService {
    private $dao;

    function __construct(){
        $this->dao = new EpisodioDAO();
    }

    public function add($request){
        $episodioServiceAdd = new EpisodioServiceAdd();
        return $episodioServiceAdd->add($request);
    }

    public function findById($animeId, $episodioId){
        $animeDAO = new AnimeDAO();
        try {
            $episodio = $this->dao->findById($episodioId);
            $episodios = $this->dao->findAll($animeId);
            $anime = $animeDAO->findById($animeId);
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }

        return [
            'anime'=> $anime,
            'episodio'=> $episodio,
            'episodios'=> $episodios
        ];
    }

    public function findAll($animeId){
        $animeDAO = new AnimeDAO();
        $anime = $animeDAO->findById($animeId);

        $episodios = $this->dao->findAll($animeId);

        return [
            'episodios' => $episodios,
            'anime' => $anime
        ];
    }
}
