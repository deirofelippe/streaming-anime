<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    public $timestamps = true;
    protected $fillable = [
        'titulo',
        'thumbnail',
        'num_temporada',
        'num_episodio',
        'views',
        'anime_id'
    ];

    public function anime(){
        return $this->belongsTo('App\Models\Anime');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','episodios_tags','episodio_id','tag_id');
    }

    public function embedVideos(){
        return $this->hasMany('App\Models\EmbedVideo');
    }
}
