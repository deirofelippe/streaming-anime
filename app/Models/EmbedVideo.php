<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmbedVideo extends Model
{
    protected $fillable = [
        'codigo_embed',
        'nome',
        'resolucao',
        'sub_dub'
    ];

    public function episodio(){
        return $this->belongsTo('App\Models\Episodio');
    }
}
