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

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap py-3 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">
            {{ env('APP_NAME') }}
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="{{ url('users/logout') }}">
                    Sair
                </a>
            </li>
        </ul>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="min-height: calc(100vh - 72px)">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}">
                                <i class="fas fa-home text-light"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('users/update') }}">
                                <i class="fas fa-user text-light"></i>
                                Meu Perfil
                            </a>
                        </li>
                    </ul>
                    @if( session('user')['role'] >= 2 ).
                        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-white">
                            <span>Administração</span>
                        </h6>
                        <ul class="nav flex-column mb-2">
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('videos/create') }}">
                                    <i class="fas fa-photo-video"></i>
                                    Novo Vídeo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('videos') }}">
                                    <i class="fas fa-photo-video"></i>
                                    Meus Vídeos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{ url('users/list') }}">
                                     <i class="fas fa-users text-light"></i>
                                    Alunos
                                </a>
                            </li>
                        </ul>
                        @endif
                    </ul>

                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{ $seo['title'] }}</h1>
                </div>

                @yield('content')

            </main>

        </div>
    </div>

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