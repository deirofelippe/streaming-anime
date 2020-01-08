<?php

namespace App\Services\Episodio;

use App\DAOs\AnimeDAO;
use App\DAOs\EpisodioDAO;
use App\Services\Episodio\EpisodioServiceAdd;
use App\Services\InterfaceService;

class EpisodioService implements InterfaceService {
    private $dao;

    function __construct(){
        $this->dao = new EpisodioDAO();
    }

    public function add($request){
        $episodioServiceAdd = new EpisodioServiceAdd();
        return $episodioServiceAdd->add($request);
    }

    public function findById($id){
        return $this->dao->findById($id);
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
