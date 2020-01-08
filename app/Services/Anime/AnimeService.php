<?php

namespace App\Services\Anime;

use App\DAOs\AnimeDAO;
use App\Services\InterfaceService;

class AnimeService implements InterfaceService {
    private $dao;

    function __construct(){
        $this->dao = new AnimeDAO();
    }

    public function add($request){
        $animeServiceAdd = new AnimeServiceAdd();
        return $animeServiceAdd->add($request);
    }

    public function findAll(){
        return $this->dao->findAll();
    }

    public function findByName($nome){
        return null;
    }
}
