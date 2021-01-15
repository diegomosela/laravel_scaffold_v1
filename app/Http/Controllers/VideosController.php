<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

use App\Models\User;
use App\Models\Video;
use App\Models\VideoView;

class VideosController extends Controller
{

    /**
     * Página Inicial - Carrega todos os vídeos
     */
    public function index() {

        $data['seo']['title']   = 'Meus Vídeos';

        $data['videos']         = Video::where('user_id', session('user')['id'])
            ->orderBy('id', 'DESC')
            ->get();

        return $this->load_view('videos.index', $data);

    }

    /**
     * Página para criar um novo vídeo
     */
    public function create() {

        $data['seo']['title'] = 'Cadastrar vídeo';

        return $this->load_view('videos.create', $data);

    }

    /**
     * POST - Cadastra um novo vídeo
     * @param  object $request  post data
     * @return json
     */
    public function store(Request $r) {

        $rules = [
            'title'             => 'required|min:10|max:200',
            'youtube'           => 'required|url',
            'description'       => 'required',
        ];
        $validator = Validator::make($r->all(), $rules);

        // validator - laravel
        if (isset($validator) && $validator->fails()) {

            return $this->resp(false, $validator->errors()->first(), 400);

        } else {

            $videoId            = youtube_id ( $r->youtube );

            if( !$videoId )
                return $this->resp(false, 'Vídeo inválido ou não encontrado', 400);

            $video              = new Video;
            $video->user_id     = session('user')['id'];
            $video->title       = ucwords($r->title);
            $video->youtube     = $videoId;
            $video->description = htmlentities($r->description);

            if( $video->save() ) {

                return $this->resp(true, 'Vídeo enviado com sucesso', 'videos');

            } else return $this->resp(false, 'Houve um erro ao enviar o vídeo');
            
        }

    }

    /**
     * Página para atualizar um vídeo
     */
    public function edit($id) {

        $data['seo']['title'] = 'Atualizar vídeo';

        $data['video']          = Video::where('user_id', session('user')['id'])
            ->where('id', $id)
            ->first();

        if( !$data['video'] )
            return $this->return('false', 'Vídeo inválido ou não encontrado', 'videos');

        return $this->load_view('videos.edit', $data);

    }

    /**
     * POST - Atualiza um vídeo
     * @param  object $request  post data
     * @return json
     */
    public function update(Request $r, $id) {

        $rules = [
            'title'             => 'required|min:10|max:200',
            'youtube'           => 'required|url',
            'description'       => 'required',
        ];
        $validator = Validator::make($r->all(), $rules);

        // validator - laravel
        if (isset($validator) && $validator->fails()) {

            return $this->resp(false, $validator->errors()->first(), 400);

        } else {

            $videoId            = youtube_id ( $r->youtube );

            if( !$videoId )
                return $this->resp(false, 'Vídeo inválido ou não encontrado', 400);

            $video              = Video::find( $id );

            if( !$video )
                return $this->resp(false, 'Impossível atualizar este vídeo', 400);

            $video->user_id     = session('user')['id'];
            $video->title       = ucwords($r->title);
            $video->youtube     = $videoId;
            $video->description = htmlentities($r->description);

            if( $video->save() ) {

                return $this->resp(true, 'Vídeo atualizado com sucesso', "videos/edit/{$id}");

            } else return $this->resp(false, 'Houve um erro ao enviar o vídeo');
            
        }

    }


    /**
     * Página de visualização de vídeo
     * @param  int $id código do videos.id
     * @return html
     */
    public function read($id) {

        $data['video']      = Video::find($id);
    
        if( $data['video'] ) {

            $data['user']       = $data['video']->user;

            $view               = new VideoView;
            $view->user_id      = session('user')['id'];
            $view->video_id     = $id;
            $view->created_at   = date('Y-m-d H:i:s');
            $view->save();

            $data['views']      = VideoView::where('video_id', $id)
                ->count();

            return $this->load_view('videos.read', $data);

        } else return $this->return(false, 'Vídeo inválido ou não encontrado', 'dashboard');

    }

    /**
     * Remove um vídeo de forma segura (soft delete) e verifica usuário
     * @param  int $id código do videos.id
     * @return redirect
     */
    public function delete($id) {

        $video = Video::where('user_id', session('user')['id'])
            ->where('id', $id)
            ->first();

        if( $video ) {

            $video->delete();
            return $this->return(true, 'Vídeo removido com sucesso', 'videos');

        } else return $this->return(false, 'Vídeo inválido ou não encontrado', 'videos');

    }


}