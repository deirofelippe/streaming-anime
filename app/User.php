<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use Notifiable;

    //avatar, cargo, minibio, data dascimento, endereco, animes assistidos,
    protected $fillable = [
        'avatar',
        'username',
        'descricao',
        'dataDeNascimento',
        'name',
        'email',
        'password',
    ];
    //crud de usuario, auth em outras paginas
    //muitos comentarios/posts (forum ou video), muitas avaliacoes,

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissoes(){
        return $this->belongsToMany('App\Models\Anime\Permissao','users_permissoes','user_id','permissao_id');
    }

    public function getAvatar(){
        $path = "storage/user/avatar/{$this->avatar}";
        return $path;
    }

    public function temPermissao($permissaoPraAcao){
        $permissoes = $this->permissoes();
        foreach ($permissoes as $permissao) {
            if($permissao->permissao == $permissaoPraAcao) {
                return true;
            }
        }
        return false;
    }
}
