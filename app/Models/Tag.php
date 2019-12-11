<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nome',
    ];

    public function episodios(){
        return $this->belongsToMany('App\Models\Episodio','episodios_tags','tag_id','episodio_id');
    }

    public function animes(){
        return $this->belongsToMany('App\Models\Anime','animes_tags','tag_id','anime_id');
    }
}
