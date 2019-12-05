<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $fillable = [
        'temporada'
    ];

    public function episodios(){
        return $this->hasMany('App\Models\Episodio');
    }

    public function anime(){
        return $this->belongsTo('App\Models\Anime');
    }
}
