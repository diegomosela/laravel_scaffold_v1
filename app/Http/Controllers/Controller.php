<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Session;

class Controller extends BaseController
{
	
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 
     */
	protected function resp($success, $message = false, $redirect = false, $statusCode = 200) {

		if( $message )
			$message = ucfirst( $message );

		if( $redirect )
			$redirect = url( $redirect );

		if( $success ) {
			$response = response()
				->json(['success' => true, 'message' => $message, 'redirect' => $redirect])
				->setStatusCode($statusCode);
		} else {
			$response = response()
				->json(['success' => false, 'message' => $message, 'redirect' => $redirect])
				->setStatusCode($statusCode);
		}

		return $response;

	}

	/**
	 * Redireciona para uma rota e define flashdata
	 * @param  boolean 	$success 	sucesso ou não
	 * @param  string 	$message 	mensagem da flashdata
	 * @param  string 	$redirect 	uri para onde será redirecionado
	 * @return redirect 301
	 */
	protected function return($success, $message, $redirect) {

		$success 	= $success ? 'success' : 'danger';
		$message 	= ucfirst( $message );

		Session::flash($success, $message);

		return redirect( $redirect );

	}

	/**
	 * Retorna uma view já comparâmetros montados
	 * @param  $view  string 		nome e pasta da view
	 * @param  array  $data   		variáveis para ser consumidas na view
	 * @param  string $template 	template da view
	 * @return view 				retorna a view montada em blade
	 */
	protected function load_view($view, $data = [], $template = 'default') {

		// Define uma página do site
		$data['template']		= "layouts/{$template}";

		// Define o SEO de um site (title, description, etc )
		$seo_default		= [
			'title'				=> 'Scaffold Laravel',
			'description'		=> '',
			'image'				=> url('assets/img/share.png')
		];

		if( isset($data['seo']) && is_array($data['seo']) )
			$data['seo']	= array_merge($seo_default, $data['seo']);
		else
			$data['seo']	= $seo_default;

		return view($view, $data);

	}

}
