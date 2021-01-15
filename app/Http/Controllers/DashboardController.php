<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Video;

class DashboardController extends Controller
{

    /**
     * Página Inicial - Carrega todos os vídeos
     */
    public function index() {

        $data['seo']['title'] = 'Dashboard';

        $data['videos']         = Video::orderBy('id', 'DESC')
        	->get();

        return $this->load_view('dashboard.index', $data);

    }

}