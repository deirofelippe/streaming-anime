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

    public function findById($id){
        $anime = $this->dao->findById($id);
        $episodios = $anime->episodios;

        return[
            'anime'=>$anime,
            'episodios'=>$episodios
        ];
    }

    public function findAll(){
        return $this->dao->findAll();
    }

    public function findByName($nome){
        return $this->dao->findByName($nome);
    }

    public function findByPalavras($nome){
        //quebrar em strings e pesquisar os animes q tenha algumas dessas palavras no nome ou na sinopse
        //
        $palavras = explode(" ", $nome);

        foreach ($palavras as $palavra) {
            $anime = $this->dao->findByName($palavra);
        }
    }
}
