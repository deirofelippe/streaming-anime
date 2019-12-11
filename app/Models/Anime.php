<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    // public $timestemps = false;
    protected $fillable = [
        'nome',
        'descricao',
        'ano_lancamento',
        'avaliacao',
        'num_avaliacoes'
    ];

    public function temporadas(){
        return $this->hasMany('App\Models\Temporada');
    }

    public function tags(){
        echo " Dentro de Tags ";
        return $this->belongsToMany('App\Models\Tag','animes_tags','anime_id','tag_id');
    }
}
