<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SessionAuthTeach
{

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // VERIFICA SE EXISTE SESSÃO DO PROFESSOR
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    public function handle($request, Closure $next) {

        $sessionUserRole = session('user')['role'] ?? NULL;

        //SE TIVER SESSÃO, INSERE LOG E CONTINUA
        if ( $sessionUserRole && $sessionUserRole >= 2 ) {
                
            return $next($request);

        //SENÃO, REDIRECIONA USUÁRIO
        } else {

            Session::flash('danger', 'Você não possui acesso a essa página');

            return redirect('dashboard');

        }

    }

}