<?php

namespace App\DAOs;

use App\User;
use Illuminate\Support\Facades\DB;

class PermissaoDAO {
    public function findByName($name){
        $name = "%{$name}%";
        // return Anime::where('nome', 'like', $name)->get();
    }
    public function findById($id){
        // return Anime::where('id', $id)->first();
    }

    public function findRoles($user){
        $user = User::find($user->id);

        $roles = DB::select(
            'select p.role from users_permissoes as up, permissoes as p '.
            'where up.user_id = ? and up.permissao_id = p.id', [$user->id]);

        return $roles;
    }
}
