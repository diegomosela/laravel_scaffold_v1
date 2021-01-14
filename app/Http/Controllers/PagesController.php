<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * Página Inicial - Redireciona para login ou dashboard
     */
    public function index() {

        if( session('user') ) {

            return redirect( 'dashboard' );

        } else {

            return redirect( 'users/login' );

        }
 

    }

}