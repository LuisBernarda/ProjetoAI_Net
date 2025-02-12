<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" href="/css/estilos.css">

    <title>ProjetoAInet</title>
</head>

<body>
    <header>
        <div id="logo">
            <img src="/img/logo.png" alt="Logo">
        </div>
        <h1>Finanças Pessoais</h1>

        @auth
            <div class="avatar-area">
                <span class="name-user">{{Auth::user()->name}}</span>
                <img src="{{Auth::user()->url_foto ? asset('storage/fotos/' . Auth::user()->url_foto) : asset('img/default_img.png') }}">
            </div>

        @else
            <div class="avatar-area">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </div>
            <div class="avatar-area">
                <a class="nav-link" href="{{ route('register') }}">Registar</a>
            </div>
        @endauth
        <div id="menuIcon">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>

    </header>
    <div class="container">
        <nav>
            <ul>
                <li class="">
                    <i class="fas fa-info-circle"></i>
                    <a href="">Apresentação</a>
                </li>
                <hr>
                @auth
                <li class="">
                    <i class="fas fa-box"></i>
                    <a href="{{ route('estatisticas', ['user' => Auth::user()]) }}">Estatistica</a>
                </li>
                @else
                <li class="">
                    <i class="far fa-file"></i>
                    <a href={{ route('login') }}>Estatistica</a>
                </li>
                @endauth
                @auth
                <li class="">
                    <i class="far fa-file"></i>
                    <a href={{route('conta.index')}}>Contas</a>
                </li>
                @else
                <li class="">
                    <i class="far fa-file"></i>
                    <a href={{ route('login') }}>Contas</a>
                </li>
                @endauth

                @auth
                <li class="">
                    <i class="fas fa-users"></i>
                    <a href="{{route('users.index')}}">Utilizadores</a>
                </li>
                @else
                <li class="">
                    <i class="far fa-file"></i>
                    <a href={{ route('login') }}>Utilizadores</a>
                </li>
                @endauth
                @auth
                <li class="">
                    <i class="far fa-file"></i>
                    <a href="{{route('users.edit', ['user' => Auth::user()]) }}">Perfil</a>
                </li>
                <li>
                    <i class="fab fa-wpforms"></i>
                    <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
                @can('viewAdm', App\User::class)
                <li class="">
                    <i class="fas fa-users"></i>
                    <a href="{{route('admin.users')}}">Administração</a>
                </li>
                @endcan
            </ul>
        </nav>

        <section id="main">
            <div class="content">
                <div class="left-content">
                    @if (session('alert-msg'))
                        <div class="alert alert-{{ session('alert-type') }}">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <span>{{ session('alert-msg') }}</span>
                        </div>
                    @endif
                    @yield('content')
                </div>
               <aside>
                    <h3>Estatísticas Gerais</h3>
                    @inject('User', 'App\Http\Controllers\UserController')
                    @inject('Conta', 'App\Http\Controllers\ContaController')
                    @inject('Movimento', 'App\Http\Controllers\MovimentoController')
                    <div class="disc-area">
                        <div class="disc">
                            <div class="disc-name">Nº Utilizadores:</div>
                            <a class="disc-count">{{ $User->counter() }}</a>
                        </div>
                        <div class="disc">
                            <div class="disc-name">Nº Contas:</div>
                            <a class="disc-count"> {{ $Conta->counter() }}</a>
                        </div>
                        <div class="disc">
                            <div class="disc-name">Nº Movimentos:</div>
                            <a class="disc-count"> {{ $Movimento->counter() }}</a>
                        </div>
                    </div>
                    <div class="bt-area">
                        <button type="button" class="bt" onclick='window.location.reload(true)'>Refresh</button>
                    </div>
                </aside>
            </div>

        </section>
    </div>
    <script src="js/menu.js"></script>
</body>

</html>
