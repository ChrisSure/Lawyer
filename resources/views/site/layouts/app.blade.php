<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta')

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body id="app">

<header class="header-site">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="{{ route('articles') }}">Юридичні статті</a>
                            <a class="nav-item nav-link" href="{{ route('about') }}">Про нас</a>
                            <a class="nav-item nav-link" href="{{ route('contacts') }}">Контакти</a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-2 col-5">
                <a href="{{ url('/') }}"><h1 class="logo">Lawyer<span>Lite</span>.Ua</h1></a>
            </div>
            <div class="col-lg-5 col-12">
                <div class="header-rigth">
                    @guest
                        <li><a class="nav-link" href="{{ route('login') }}">Логін</a></li>
                        <li><a class="nav-link" href="{{ route('register') }}">Реєстрація</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'super_admin' || Auth::user()->role == 'moderator')
                                    <a class="dropdown-item" href="{{ route('admin.home') }}">Admin</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('cabinet.home') }}">Кабінет</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                    Вихід
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</header>

<main class="main-site">
    <div class="container">
        @section('breadcrumbs', Breadcrumbs::render())
        @yield('breadcrumbs')
        @include('site.layouts.partials.flash')
        @yield('content')
    </div>
</main>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>