<?php

namespace App\DAOs;

use App\O;
use App\User;
use Illuminate\Support\Facades\DB;

class UserDAO {
    public function findAll(){
        $users = User::all();
        return $this->findAllUsersRoles($users);
        // return $users;
    }

    public function findById($id){
        $user = User::find($id);
        return $this->findAllRoles($user);
    }

    public function findByName($name){
        $user = User::where('name', $name);
        return $this->findAllRoles($user);
    }

    private function findAllRoles($user){
        $roles = DB::select(
            'select p.role from users_permissoes as up, permissoes as p '.
            'where up.user_id = ? and up.permissao_id = p.id', [$user->id]);

        $user->setRoles($roles);

        return $user;
    }

    private function findAllUsersRoles($users){
        $permissaoDAO = new PermissaoDAO();

        $new = $users->map(function($user) use($permissaoDAO){
            $roles = $permissaoDAO->findRoles($user);
            $user->setRoles($roles);
            return $user;
        });

        return $new;
    }
}
