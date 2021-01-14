<html lang="pt-br">
<head>

	<title>{{ $seo['title'] }} - {{ env('APP_NAME') }}</title>

	<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

    <meta charset="UTF-8"/>

    <meta name="language" 		content="pt-br" />
    <meta name="distribution" 	content="global" />
    <meta name="robots" 		content="index, follow" />
    <meta name="rating" 		content="general" />
    <meta name="googlebot" 		content="1. yes" />
    <meta name="robots" 		content="noarchive" />
    <meta name="viewport" 		content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="base_url"       content="{{ url('/') }}" />
    <meta name="csrf-token"     content="{{ csrf_token() }}"> 

    <!-- CSS -->
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css" >
    
    @yield('css')

</head>
<body>

    <main>
	   @yield('content')
    </main>

    <div id="loading" class="text-center pt-5 d-none">
        <i class="fas fa-spinner fa-spin my-5 fa-10x"></i>
        <p class="font-size-18 font-weight-bold">{{ 'CARREGANDO' }}</p>
    </div>

    <div id="alertMessage" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p class="py-3 m-0"></p>
            </div>
        </div>
    </div>

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('assets/js/all.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/main.min.js') }}"></script>

	@yield('js')

    <script>
    @if( Session::has('success') )
        message('success', '{{ Session::get('success') }}' );
    @elseif( Session::has('danger') )
        message('danger',  '{{ Session::get('danger') }}' );
    @endif
    </script>

</body>
</html>