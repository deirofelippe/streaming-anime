<?php

namespace App\Models\Anime;

use Illuminate\Database\Eloquent\Model;

class Analise extends Model
{
    protected $fillable = [
        'analise',
        'avaliacao_id'
    ];

    public function avaliacao(){
        return $this->belongsTo('App\Models\Anime\Avaliacao');
    }
}
