<?php

namespace App\Http\Middleware;

use Closure;
use Session;

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

            Session::flash('danger', 'Realize o login antes de continuar');

            return redirect('/users/logout');

        }

    }

    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
    //FUNÇÃO PRIVADA - INSERE O LOG DO USUÁRIO (TODOS)
    // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    private function insert_log($request, $sessionUserId) {

        $log = [
            'user_id'       => $sessionUserId,
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