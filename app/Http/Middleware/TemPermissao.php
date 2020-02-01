<?php

namespace App\Http\Middleware;

use App\O;
use App\Services\UserService;
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
    public function handle($request, Closure $next, $roleDaAcao){
        $user = Auth::user();
        $userService = new UserService();

        if($userService->temPermissao($user, $roleDaAcao)){
            return $next($request);
        }
    }
}
