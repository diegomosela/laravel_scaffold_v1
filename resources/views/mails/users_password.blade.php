@extends('mails/layout')

@section('content')

	@php
	$url = url( "users/password/{$token}" );
	@endphp
	<p>
		{{ 'Heey, nós identificados uma solicitação de recuperar sua senha. Caso você não tenha realizado essa solicitação, por favor ignore esta mensagem.' }}
	</p>

	<p>
		{{ 'Sua chave secreta possui uma validação de 48 horas, após esse período será necessário solicitar novamente.' }}
	</p>

	<p style="margin-top: 30px">
		{!! 'Click on the button below to <b> recover your password:</b>' !!}
		<br/><br/>
		<a href="{{ $url }}" style="display: inline-block; background: #128c7e; padding: 10px 25px; color: #FFF; border-radius: 25px; text-decoration: none; font-weight: bold;" target="_blank">
			{{ 'RECUPERAR SENHA' }}
		</a>
		<br/><br/>
		<small>
			{{ 'ou acesse' }}
			<br/>
			<a href="{{ $url }}" style="font-size: 12px; text-decoration: none;">
				{{ $url }}
			</a>
		</small>
	</p>

@endsection