<?php

namespace App;

use App\Models\Anime\Permissao;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

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
        return $this->belongsToMany(Permissao::class);
    }

    public function getAvatar(){
        $path = "storage/user/avatar/{$this->avatar}";
        return $path;
    }

    public function temPermissao($roleDaAcao, $permissoesDoUser){
        foreach ($permissoesDoUser as $permissao) {
            if($permissao->role == $roleDaAcao) {
                return true;
            }
        }
        return false;
    }
}
