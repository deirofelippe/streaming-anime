<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'titulo',
        'descricao',
        'numero_episodio',
        'views',
        'avaliacao',
        'num_avaliacoes'
    ];

    public function temporada(){
        return $this->belongsTo('App\Models\Temporada');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag', 'episodio_tag', 'episodio_id', 'tag_id');
    }

    public function embedVideos(){
        return $this->hasMany('App\Models\EmbedVideo');
    }
}
