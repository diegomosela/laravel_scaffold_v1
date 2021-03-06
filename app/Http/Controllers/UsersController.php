<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * Login (GET)
     */
    public function login() {

        $data['seo']['title']   = 'Login';

        return $this->load_view('users/login', $data, 'users');

    }

    /**
     * Login (GET)
     */
    public function login_post(Request $r) {

        $rules = [
            'email'             => 'required|max:200',
            'password'          => 'required|min:6',
        ];
        $validator = Validator::make($r->all(), $rules);

        // validator - laravel
        if (isset($validator) && $validator->fails()) {

            return $this->resp(false, $validator->errors()->first(), 400);

        } else {

            $username   = strtolower( trim ( $r->email ) );

            $user       = User::where('status', 1)
                ->where(function($query) use ($username) {
                    $query->where('email', $username)
                        ->orWhere('username', $username);
                })
                ->first();

            if( $user ) {

                // Verifica se password é válido
                if ( Hash::check($r->password, $user->password) ) {

                    // Cria a sessão
                    $this->session_create( $user );

                    return $this->resp(true, 'acesso realizado com sucesso', 'dashboard');

                } else return $this->resp(false, 'sua senha de acesso é inválida');

            } else return $this->resp(false, 'usuário inválido ou não encontrado');

        }

    }

    /**
     * Logout (GET)
     * Encerra a sessão do usuário
     */
    public function logout() {

        session(['user' => NULL]);

        return redirect( 'users/login' );

    }


    /**
     * Create (GET)
     */
    public function create() {

        $data['seo']['title']   = 'Criar conta';

        return $this->load_view('users/create', $data, 'users');

    }

    /**
     * Create (POST)
     *
     * @param  \Illuminate\Http\Request  $r
     */
    public function store(Request $r) {

        $rules = [
            'name'              => 'required|max:50',
            'email'             => 'required|max:200|email|unique:users,email',
            'password'          => 'required|min:6',
        ];
        $validator = Validator::make($r->all(), $rules);

        // validator - laravel
        if (isset($validator) && $validator->fails() ) {

            return $this->resp(false, $validator->errors()->first(), 400);

        } else {

            // trata dados para inserir
            $user                       = new User;
            $user->public_key           = md5( uniqid() . $r->email );
            $user->role_id              = 1;
            $user->name                 = ucfirst($r->name);
            $user->username             = explode('@', $r->email)[0] . rand(11111,99999);
            $user->email                = strtolower( trim( $r->email ) );
            $user->password             = Hash::make( $r->password );

            if( $user->save() ) {
                
                // Cria a sessão
                $this->session_create( $user );
                
                return $this->resp(true, 'conta criada com sucesso', 'dashboard');

            } else return $this->resp(false, 'houve um erro ao inserir novo usuário');

        }

    }

    /**
     * Edit (GET)
     */
    public function edit() {

        $sessionUserId          = session('user')['id'];

        $data['seo']['title']   = 'Atualizar conta';

        $data['user']           = User::find($sessionUserId);

        return $this->load_view('users/edit', $data);

    }

    /**
     * Update (POST)
     *
     * @param  \Illuminate\Http\Request  $r
     */
    public function update(Request $r) {

        $sessionUserId      = session('user')['id'];

        $rules              = [
            "name"              => "required|min:5|max:50",
            "username"          => "required|min:3|max:30|unique:users,username,{$sessionUserId}",
            "email"             => "required|max:200|email|unique:users,email,{$sessionUserId}",
            "password"          => "nullable|min:6",
        ];
        $validator = Validator::make($r->all(), $rules);

        // validator - laravel
        if (isset($validator) && $validator->fails()) {

            return $this->resp(false, $validator->errors()->first(), 400);

        } else {

            // trata dados para inserir
            $user                       = User::find($sessionUserId);
            $user->name                 = ucfirst($r->name);
            $user->username             = strtolower( trim( $r->username) );
            $user->email                = strtolower( trim( $r->email ) );

            // atualiza senha somente se vier campo
            if( $user->password )
                $user->password         = Hash::make( $r->password );

            if( $user->save() ) {
                
                // Atualiza a sessão
                $this->session_create( $user );
                
                return $this->resp(true, 'conta atualizada com sucesso', 'users/edit');

            } else return $this->resp(false, 'houve um erro ao inserir novo usuário');

        }

    }


    /**
     * Gera um token para usuário recuperar senha
     * [POST] /users/password
     * 
     * @param  string $email
     */
    public function password_post( Request $r ) {

        $validator = Validator::make($r->all(), [
            'email'             => 'required|email',
        ]);

        if( $validator->fails() ) {

            return $this->resp(false, $validator->errors()-> first());

        } else {

            // secret random token
            $token  = token_public( date('YmdHis') );

            $user   = User::where('email', $r->email)
                ->where('status', 1)
                ->first();

            if( $user ) {

                $ut             = new \App\Models\UserToken;
                $ut->token      = $token;
                $ut->user_id    = $user->id;
                $ut->type       = 1;

                if( $ut->save() ):

                    $dt = [
                        'to'        => $user->email,
                        'to_name'   => $user->name,
                        'subject'   => 'Recupere sua senha',
                        'view'      => 'users_password',
                        'token'     => $token,
                    ];
                    \App\Libraries\Webmails::mail_send($dt, $user->id);

                endif;

            }

        }

        return $this->resp(true, 'caso esse usuário seja válido, um e-mail foi enviado');

    }

    /**
     * Tela para cadastrar novo password
     * @param  string $token token secreto para validar
     * @return html
     */
    public function password($token) {

        $data['token']  = $token = \App\Models\UserToken::where('token', $token)
            ->where('type', 1)
            ->first();

        if( $token ) {

            $data['user']   = User::find( $token->user_id );

            // verifica se token ainda é válido (2 dias)
            if( date('Y-m-d H:i:s', strtotime('-2 days') ) >= $token->created_at )
                return $this->return(false, 'sua chave secreta expirou, gere uma nova para continuar', 'users/login');

            $data['seo']['title']   = 'Recuperar senha';

            return $this->load_view('users/password', $data, 'users');

        } else {

            return $this->return(false, 'chave secreta inválida ou não encontrada', 'users/login');

        }


    }

    /**
     * Verifica token e cria novo password
     * [POST] users/password/{token}
     * 
     * @param  string $password, $password_confirm
     */
    public function password_recovery_post( Request $r, $token ) {

        $token  = \App\Models\UserToken::where('token', $token )
            ->first();

        if( $token ) {

            // verifica se token ainda é válido (2 dias)
            if( date('Y-m-d H:i:s', strtotime('-2 days') ) >= $token->created_at )
                return $this->resp(false, 'sua chave secreta expirou, gere uma nova para continuar');

            // form validator
            $validator = Validator::make($r->all(), [
                'password'          => 'nullable|min:6',
                'password_confirm'  => 'required_with:password|same:password|min:6'
            ]);

            if( $validator->fails() ) {

                return $this->resp(false, $validator->errors()-> first());

            } else {

                // busca pelo usuário
                $user               = User::find( $token->user_id );
                $user->password     = Hash::make( $r->password );

                // atualiza usuário
                if( $user->save() ) {

                    $token->delete();
                    return $this->resp(true, 'sua senha foi alterada e atualizada com sucesso', 'users/login');

                } else return $this->resp(false, 'falha ao atualizar nova senha');

            }

        } else return $this->resp(false, 'chave secrete inválida ou não encontrada');

    }

    /**
     * Listagem de alunos ativos no sistema
     */
    public function list(Request $r) {

        $data['seo']['title']   = 'Lista de alunos';

        $user                   = User::where('role_id', '<', '2');

        // Se vier busca, pesquisa nas condições
        if( $r->search ):
            $user->where(function($query) use ($r) {
                $query->where('name', "like", "%{$r->search}%")
                    ->orWhere('email', "like", "%{$r->search}%")
                    ->orWhere('id', "like", "%{$r->search}%");
            });
        endif;
            
        $data['users']          = $user->get();
        $data['r']              = $r;

        return $this->load_view('users.list', $data);

    }

    /*
    *
    * P R I V A T E S 
    *
    */

    /**
     * Cria ou atualiza a sessão do usuário
     * @param object $user dados do usuário
     */
    private function session_create( $user ) {

        return session([
            'user' => [
                'id'        => $user->id,
                'role'      => $user->role_id,
                'name'      => $user->name,
                'username'  => $user->username,
                'email'     => $user->email
            ]
        ]);
    }
}