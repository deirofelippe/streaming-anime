<?php

namespace App\Services;

use App\DAOs\PermissaoDAO;
use App\DAOs\UserDAO;
use App\Models\Anime\Permissao;
use App\O;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Hash;

class UserService {
    private $dao;

    function __construct(){
        $this->dao = new UserDAO();
    }

    public function temPermissao($user, $roleDaAcao){
        $permissaoDAO = new PermissaoDAO();
        $rolesDoUsuario = $permissaoDAO->findRoles($user);

        return $user->temPermissao($roleDaAcao, $rolesDoUsuario);
    }

    public function findAll(){
        $users = $this->dao->findAll();
        return $users;
    }

    public function add($data){
        error_log('uu');
        O::o($data);

        if(Gate::allows('isAdmin')){
            return $this->createComoAdmin($data);
        }

        return $this->createSemAdmin($data);
    }

    private function createSemAdmin($data){
        $user = User::create([
            'avatar' => $data['avatar'],
            'username' => $data['username'],
            'descricao' => $data['descricao'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return $user;
    }

    private function createComoAdmin($data){
        print_r($data['permissao']);
        $data->o;

        $user = User::create([
            'avatar' => $data['avatar'],
            'username' => $data['username'],
            'descricao' => $data['descricao'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $permissao = Permissao::where('permissao', $data['permissao'])->first();

        $user->permissoes()->attach($permissao->id);
        return $user;
    }
}
