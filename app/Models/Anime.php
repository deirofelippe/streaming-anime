<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        'nome',
        'thumbnail',
        'descricao',
        'ano_lancamento',
        'views'
    ];

    public function episodios(){
        return $this->hasMany('App\Models\Episodio');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','animes_tags','anime_id','tag_id');
    }
}
