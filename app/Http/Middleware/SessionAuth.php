<?php

namespace App\Http\Middleware;

use Closure;

class SessionAuth
{

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    // VERIFICA SE EXISTE SESSÃO DO (TODOS)
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    public function handle($request, Closure $next) {

        $sessionUserId = session('user')['id'] ?? NULL;

        //SE TIVER SESSÃO, INSERE LOG E CONTINUA
        if ( $sessionUserId && $sessionUserId > 0 ) {
                
            @$this->insert_log($request, $sessionUserId);

            return $next($request);

        //SENÃO, REDIRECIONA USUÁRIO
        } else {

            return redirect('/users/logout'); exit;

        }

    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    //FUNÇÃO PRIVADA - INSERE O LOG DO USUÁRIO (TODOS)
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    private function insert_log($request, $sessionUserId) {

        $log = [
            'user_id'       => $sessionUserId,
            'role'          => session('user')['role'] ?? NULL,
            'url'           => $request->path(),
            'method'        => $request->method(),
            'ip'            => $request->ip(),
            'agent'         => $request->header('user-agent'),
            'json'          => json_encode($request->input()),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        return \App\Models\UserLog::insert( $log );

    }

}