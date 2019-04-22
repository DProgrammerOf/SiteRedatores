<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/justified-nav.css') }}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">

                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand"     >
                        @yield('page')
                    </a>
                </div>



                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @auth
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>
                                    {{ Auth::user()->name }}  <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if(Auth::user()->admin)
                                    <li> 
                                        <a href="{{ route('paineladmin') }}"><span class="glyphicon glyphicon-tasks"></span>
                                            Painel de Controle
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="{{ route('register') }}"><span class="glyphicon glyphicon-plus-sign"></span>
                                            Adicionar Usuário
                                        </a>
                                    </li>
                                    @endif
                                    <li >
                                        <a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span>
                                            Home
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{ route('incluir') }}"><span class="glyphicon glyphicon-plus"></span>
                                        Incluir Texto
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{ route('criticar') }}"><span class="glyphicon glyphicon-edit"></span>
                                        Criticar
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{ route('resultados') }}"><span class="glyphicon glyphicon-share"></span>
                                        Resultados
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{ route('regulamento') }}"><span class="glyphicon glyphicon-info-sign"></span>
                                        Regulamento
                                        </a>
                                    </li>
                                    <li >
                                        <a href="{{ route('contato') }}"><span class="glyphicon glyphicon-envelope"></span>
                                        Contato
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-off"></span>
                                            Sair
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>

             @auth
        <div id="menufix" class="container" style="width: 100%">
            <div class="row">
                <div class="">
                  <ul class="nav nav-justified">
                    <li @if($page == 'home') class="active" @endif><a href="{{ route('home') }}">Home</a></li>
                    <li @if($page == 'incluir') class="active" @endif><a href="{{ route('incluir') }}">Incluir Texto</a></li>
                    <li @if($page == 'criticar') class="active" @endif><a href="{{ route('criticar') }}">Criticar</a></li>
                    <li @if($page == 'resultados') class="active" @endif><a href="{{ route('resultados') }}">Resultados</a></li>
                    <li @if($page == 'regulamento') class="active" @endif><a href="{{ route('regulamento') }}">Regulamento</a></li>
                    <li @if($page == 'contato') class="active" @endif><a href="{{ route('contato') }}">Contato</a></li>
                  </ul>
                </div>
            </div>
        </div>
        @endauth
        </nav>

        @yield('content')
    </div>
    @yield('content-back')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    window.onscroll = function() {myFunction()};

    var header = document.getElementById("menufix");
    var sticky = header.offsetTop;

    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
      } else {
        header.classList.remove("sticky");
      }
    }
    </script>
</body>
</html>
