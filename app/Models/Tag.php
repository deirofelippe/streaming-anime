<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'nome',
    ];

    public function episodios(){
        return $this->belongsToMany('App\Models\Episodio', 'episodio_tag', 'tag_id', 'episodio_id');
    }

    public function animes(){
        return $this->belongsToMany('App\Models\Anime', 'anime_tag', 'tag_id', 'anime_id');
    }
}
