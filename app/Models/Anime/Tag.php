<?php

namespace App\Models\Anime;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nome',
    ];

    public function episodios(){
        return $this->belongsToMany('App\Models\Anime\Episodio','episodios_tags','tag_id','episodio_id');
    }

    public function animes(){
        return $this->belongsToMany('App\Models\Anime\Anime','animes_tags','tag_id','anime_id');
    }
}
