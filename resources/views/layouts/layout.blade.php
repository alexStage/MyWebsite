<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="{{URL::asset('/')}}" target="_blank">
        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/siteTahiti.css')}}">
        <link rel="icon" href="asset('storage/img/logo-laeti.jpg')" />
        <script type="text/javascript" src="{{url('js/phaser.js')}}"></script>
        <script type="text/javascript" src="{{url('js/phaser.min.js')}}"></script>
        <script type="text/javascript" src="{{url('js/jQuery.js')}}"></script>
        <script type="text/javascript" src="{{url('js/clock.js')}}"></script>
        <title>Site Tahiti</title>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" target="_self" href="#">
            <img src="{{asset('storage/img/logo-laeti.jpg')}}" width="60" height="60" alt=""> Manava
        </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" target="_self" href="{{route('messages.index')}}">Messages</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" target="_self" href="{{route('albums.index')}}">Albums</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" target="_self" href="{{route('games.index')}}">Jeu</a>
                        </li>
                    </ul>   
                @endauth
            </div>
            <script type="text/javascript">
                window.onload=function() {
                horloge('div_horloge');
              };
            </script>
              
            <ul class="navbar-nav justify-content-center" id="div_horloge"></ul>
            
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @auth
                @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" target="_self" href="{{ route('register') }}">{{ __('Senregistrer') }}</a>
                        </li>
                @endif
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" target="_self" href="{{ route('login') }}">{{ __('Login') }}</a>
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
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
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
