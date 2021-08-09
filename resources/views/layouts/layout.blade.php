<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <base href="{{URL::asset('/')}}" target="_blank">
        <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/siteTahiti.css')}}">
        <link rel="stylesheet" type="text/css" href="{{url('css/simple-sidebar.css')}}">
        <link rel="icon" href="{{asset('assets/seaTheWorld2.png')}}">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/app.js') }}" ></script>
        <script type="text/javascript" src="{{url('js/jQuery.js')}}"></script>
        <script src="https://kit.fontawesome.com/ef75b9cf35.js" crossorigin="anonymous"></script>
        <title>Carnet de voyages</title>
    </head>
    <body>

    <nav id="nav" class="navbar navbar-expand-lg navbar-light bg-blue">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> 
        <div class="collapse navbar-collapse navbar-header" id="navbarTogglerDemo01">
            <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" target="_self" href="{{route('albums.index')}}">Albums</a>
                    </li>
                    @auth
                        <li class="nav-item active">
                            <a class="nav-link" target="_self" href="{{route('messages.index')}}">Messages</a>
                        </li>
                        @if(Auth::user()->isFamily())
                            <li class="nav-item active">
                                <a class="nav-link" target="_self" href="{{route('archives')}}">Archives</a>
                            </li>
                        @endif
                    @endauth
            </ul>


            <ul class="navbar-nav navbar-center">
                <li><a class="navbar-brand" target="_self" href="#"><img src="{{asset('assets/seaTheWorld2.png')}}" width="164" height="105" alt=""></a></li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('register'))
                        <li>
                            <a class="nav-link" target="_self" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                        </li>
                @endif
                    <li>
                        <a class="nav-link" target="_self" href="{{ route('login') }}"><span class="glyphicon glyphicon-user"></span>{{ __('Se connecter') }}</a>
                    </li>
                @else

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" target="_self" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Se déconnecter') }}
                        </a>
                        <a class="dropdown-item" href="{{route('profile.photo')}}">
                            {{ __('ajouter photo de profile') }}
                        </a>
                        @if(Auth::user()->isAdmin())
                        <a class="dropdown-item" target="_self" href="{{route('admin')}}">
                            {{ __('Admin') }}
                        </a>
                        @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>               
    </nav>
            <div class="container">
            @if(Session::has('danger'))
                <div class="alert alert-danger text-center" role="alert">
                    {{session('danger')}}
                </div>
            @endif
            @if(Session::has('warning'))
                <div class="alert alert-warning text-center" role="alert">
                    {{session('warning')}}
                </div>
            @endif
<!--             @if(Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{session('success')}}
                </div>
            @endif -->
            </div>

            @yield('content')
            

        <script type="text/javascript" src="{{url('js/popper.min.js')}}"></script>        
        <script type="text/javascript" src="{{url('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{url('js/button-folder.js')}}"></script>
        <script>
        $(document).ready(function() {
            // Send refresh second time to avoid display errors
            if (window.location.href.indexOf('?refresh') != -1) {
            window.location.href = window.location.href.replace('?refresh', '');
            return;
            }
            });
        </script>
        <!-- <script>
        $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
        });
        </script> -->
        
    </body>
</html>
