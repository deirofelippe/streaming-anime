<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class TemPermissao
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $tipoDeUsuario){
        $user = User::find(Auth::id());

        if($user->temPermissao($tipoDeUsuario)){
            return $next($request);
        }
    }
}
