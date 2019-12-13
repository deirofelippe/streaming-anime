<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmbedVideo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'codigo_embed',
        'nome',
        'resolucao',
        'sub_dub',
        'episodio_id'
    ];

    public function episodio(){
        return $this->belongsTo('App\Models\Episodio');
    }
}
