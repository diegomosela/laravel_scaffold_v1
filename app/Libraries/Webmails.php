<?php

namespace App\Libraries;

use App\Models\Message;

use App\Http\Controllers\Controller as Controller;

class Webmails extends Controller 
{

	// - - - - - - - - - - - - - - - - - - - - - - - - - - - 
	// MAIL - SEND
	/*
	$webmail = [
		'to'		=> 'xyz@email.com',
		'to_name'	=> 'José',
		'subject'	=> "Bem-vindo!",
		'view'		=> 'message_welcome',
	];
	\App\Libraries\Webmails::mail_send($webmail);
	*/
	public static function mail_send( $data, $user_id = false ) {

		$to 		= $data['to'] ?? false;
		$to_name	= $data['to_name'] ?? false;
		$subject 	= $data['subject'] ?? false;
		$view 		= view("mails.{$data['view']}", $data)->render();

		// Valida se campos são válidos
		if( !$to || !$to_name || !$subject || env('MAIL_SENDBLUE_API_V3') )
			return false;

		$post = json_encode([
			'sender' 		=> [
				'name'			=> env('MAIL_FROM_NAME'),
				'email'			=> env('MAIL_FROM_ADDRESS')
			],
			'to'			=> [
				[
					'name'			=> $to_name,
					'email'			=> $to
				]
			],
			'subject'		=> $subject,
			'htmlContent' 	=> $view
		]);

		$header = [
	    	"api-key:" . env('MAIL_SENDBLUE_API_V3'),
	    	"Content-Type: application/json",
	  	];	  	    

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  	CURLOPT_URL 				=> "https://api.sendinblue.com/v3/smtp/email",
		  	CURLOPT_RETURNTRANSFER 		=> true,
		  	CURLOPT_ENCODING 			=> "",
		  	CURLOPT_MAXREDIRS 			=> 10,
		  	CURLOPT_TIMEOUT 			=> 0,
		  	CURLOPT_FOLLOWLOCATION 		=> true,
		  	CURLOPT_HTTP_VERSION 		=> CURL_HTTP_VERSION_1_1,
		  	CURLOPT_SSL_VERIFYHOST		=> 0,
			CURLOPT_SSL_VERIFYPEER		=> 0,
		  	CURLOPT_CUSTOMREQUEST 		=> "POST",
		  	CURLOPT_POSTFIELDS 			=> $post,
		  	CURLOPT_HTTPHEADER 			=> $header
		));
		$response = json_decode( curl_exec($curl) );
		curl_close($curl);		    

		// SE SUCESSO, GRAVA NO BANCO
        if( isset($response->messageId) && $response->messageId) {

        	$mail  				= new Message;
        	$mail->user_id 		= $user_id;
        	$mail->external_id 	= $response->messageId;
        	$mail->type 		= 1;
        	$mail->from 		= env('MAIL_FROM_NAME');
        	$mail->to 			= $to;
        	$mail->subject 		= $subject;
        	$mail->message 		= $data['view'];

        	return $mail->save();

        } else {

        	$log 	 = "Erro ao enviar email:";
        	$log 	.= " | POST: " . json_encode($post);
        	$log 	.= " | RESP: " . json_encode($response);
        	\App\Helpers\DiscordHelper::send_log_webhook( $log, 'danger');

        	return false;

        }

	}

}