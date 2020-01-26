<?php

namespace App\Models\Anime;

use Illuminate\Database\Eloquent\Model;

class Permissao extends Model{

    public $timestamps = false;
    protected $fillable = [
        'permissao'
    ];

    public function users(){
        return $this->belongsToMany('App\User','users_permissoes','permissao_id','user_id');
    }
}
