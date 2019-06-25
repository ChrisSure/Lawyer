<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lawyer-Admin</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body id="app">
    <header class="header-admin">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="{{ route('admin.home') }}">Головна</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.users.index') }}">Користувачі</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin.documents.html">Сформовані документи</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.articles.index') }}">Юридичні статті</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="admin.finance.html">Фінанси</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Зворотні зв'язок
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.reverse.index') }}">Листи від користувачів</a>
                                        <a class="dropdown-item" href="{{ route('admin.mail.index') }}">Розсилка</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Настройки
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('admin.pages.index') }}">Сторінки</a>
                                        <a class="dropdown-item" href="{{ route('admin.logs.index') }}">Логи</a>
                                        <a class="dropdown-item" href="{{ route('admin.info.index') }}">Інформація</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-2">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link logout" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Вийти</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <main class="main-admin">
        <div class="container">
            <div class="row">
                <div class="col">
                    @section('breadcrumbs', Breadcrumbs::render())
                    @yield('breadcrumbs')
                    @include('admin.layouts.partials.flash')
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>
