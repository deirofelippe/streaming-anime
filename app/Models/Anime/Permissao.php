<?php

namespace App\Models\Anime;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Permissao extends Model{

    public $timestamps = false;
    protected $fillable = [
        'permissao'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
