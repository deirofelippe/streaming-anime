<?php

namespace App\Services;

use App\O;
use Illuminate\Support\Facades\DB;

class UserService {
    public function temPermissao($user, $role){
        // $dao = UserPermissaoDAO();

        $permissoes = DB::select(
            'select p.role from users_permissoes as up, permissoes as p '.
            'where up.user_id = ? and up.permissao_id = p.id', [$user->id]);

        return $user->temPermissao($role, $permissoes);
    }
}
