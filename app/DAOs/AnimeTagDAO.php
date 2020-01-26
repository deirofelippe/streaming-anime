<?php

namespace App\DAOs;

use Illuminate\Support\Facades\DB;

class AnimeTagDAO {

    public function add($anime, $tagId){
        return $anime->tags()->attach($tagId);
    }

    public function findAll(){}

    public function findById($animeId, $tagId){
        return DB::table('animes_tags')->where([
            ['anime_id', $animeId],
            ['tag_id', $tagId],
            ])->first();
    }
}
