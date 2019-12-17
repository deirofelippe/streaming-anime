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
        'video',
        'views',
        'anime_id'
    ];

    public function getVideo(){
        return "storage/video/{$this->video}";
    }

    public function getThumbnail(){
        return "storage/thumbnail/episodio/{$this->thumbnail}";
    }

    public function anime(){
        return $this->belongsTo('App\Models\Anime');
    }
}
