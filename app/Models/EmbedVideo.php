<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmbedVideo extends Model
{
    protected $fillable = [
        'html_embed_video',
        'nome',
        'resolucao',
        'sub_dub'
    ];

    public function episodio(){
        return $this->belongsTo('App\Models\Episodio');
    }
}
