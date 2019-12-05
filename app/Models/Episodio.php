<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'titulo',
        'numeroEpisodio',
        'descricao',
        'avaliacao',
        'qtdViews'
    ];

    public function temporada(){
        return $this->belongsTo('App\Models\Temporada');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    public function embedVideos(){
        return $this->hasMany('App\Models\EmbedVideo');
    }
}
