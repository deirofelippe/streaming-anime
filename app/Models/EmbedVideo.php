<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmbedVideo extends Model
{
    protected $fillable = [
        'htmlEmbedVideo',
        'nome',
        'resolucao',
        'subDub'
    ];

    public function episodio(){
        return $this->belongsTo('App\Models\Episodio');
    }
}
