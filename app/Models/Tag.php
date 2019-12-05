<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'nome',
    ];

    public function episodios(){
        return $this->belongsToMany('App\Models\Episodio');
    }

    public function animes(){
        return $this->belongsToMany('App\Models\Anime');
    }
}
