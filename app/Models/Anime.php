<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = [
        'nome',
        'thumbnail',
        'descricao',
        'ano_lancamento',
        'status',
        'views'
    ];

    public function getStatus(){
        $status = $this->fillable->status;
        switch ($status) {
            case 0:
                $valor = "Em andamento";
                break;
            case 1:
                $valor = "Concluído";
                break;
            case 2:
                $valor = "Cancelado";
                break;
        }
        return $valor;
    }

    public function episodios(){
        return $this->hasMany('App\Models\Episodio');
    }

    public function avaliacao(){
        return $this->hasOne('App\Models\Avaliacao');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','animes_tags','anime_id','tag_id');
    }
}
