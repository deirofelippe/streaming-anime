<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'anoLancamento',
        'avaliacao'
    ];

    public function temporadas(){
        return $this->hasMany('App\Models\Temporada');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }
}
