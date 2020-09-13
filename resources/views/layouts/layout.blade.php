<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="{{URL::asset('/')}}" target="_blank">
        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/siteTahiti.css')}}">
        <link rel="icon" href="{{asset('storage/img/logo-laeti.jpg')}}">
        <script type="text/javascript" src="{{url('js/phaser.min.js')}}"></script>
        <script type="text/javascript" src="{{url('js/jQuery.js')}}"></script>
        <script type="text/javascript" src="{{url('js/clock.js')}}"></script>
        <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
        <title>Carnet de voyages</title>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" target="_self" href="#">
            <img src="{{asset('storage/img/logo-laeti.jpg')}}" width="60" height="60" alt=""> Manava
        </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" target="_self" href="{{route('messages.index')}}">Messages</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" target="_self" href="{{route('albums.index')}}">Albums</a>
                        </li>
                        <li class="nav-item active">
                        <a class="nav-link" target="_self" href="{{route('downloads')}}">Téléchargements</a>
                        </li>
                    </ul>   
                @endauth
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @if (Route::has('register'))
                            <li>
                                <a class="nav-link" target="_self" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                            </li>
                    @endif
                    @guest
                        <li>
                            <a class="nav-link" target="_self" href="{{ route('login') }}"><span class="glyphicon glyphicon-user"></span>{{ __('Se connecter') }}</a>
                        </li>
                    @else

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Se déconnecter') }}
                                </a>
                                <a class="dropdown-item" href="{{route('profile.photo')}}">
                                    {{ __('ajouter photo de profile') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
            
    </nav>



            @if(Session::has('status'))
                <div class="alert alert-primary" role="alert">
                    {{session('status')}}
                </div>
            @endif
            <br>
            <br>
            @yield('content')
            

        <script type="text/javascript" src="{{url('js/popper.min.js')}}"></script>        
        <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
    </body>
</html>
