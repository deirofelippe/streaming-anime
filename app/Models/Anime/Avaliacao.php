<?php

namespace App\Models\Anime;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = [
        'estrelas',
        'anime_id'
    ];

    public function anime(){
        return $this->belongsTo('App\Models\Anime\Anime');
    }

    public function analise(){
        return $this->hasOne('App\Models\Anime\Analise');
    }
}
