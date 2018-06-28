<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'i2CAT') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style type="text/css">
        /* Smartphones (portrait and landscape) ----------- */  
        @media only screen  
        and (min-width : 320px)  
        and (max-width : 480px) {  
        /* Styles */
            .pant{
                display: none;
            }
        }  
        /* Smartphones (landscape) ----------- */  
        @media only screen  
        and (min-width : 321px) {  
        /* Styles */
        }  
        /* Smartphones (portrait) ----------- */  
        @media only screen  
        and (max-width : 320px) {  
        /* Styles */
              
        }  
        /* iPads (portrait and landscape) ----------- */  
        @media only screen  
        and (min-width : 768px)  
        and (max-width : 1024px) {  
        /* Styles */
        }  
        /* iPads (landscape) ----------- */  
        @media only screen  
        and (min-width : 768px)  
        and (max-width : 1024px)  
        and (orientation : landscape) {  
        /* Styles */  
        }  
        /* iPads (portrait) ----------- */  
        @media only screen  
        and (min-width : 768px)  
        and (max-width : 1024px)  
        and (orientation : portrait) {  
        /* Styles */  
        }  
        /* Desktops and laptops ----------- */  
        @media only screen  
        and (min-width : 1224px) {
        /* Styles */  
        }  
        /* Large screens ----------- */  
        @media only screen  
        and (min-width : 1824px) {  
        /* Styles */  
        }  
        /* iPhone 4 ----------- */  
        @media  
        only screen and (-webkit-min-device-pixel-ratio : 1.5),  
        only screen and (min-device-pixel-ratio : 1.5) {  
        /* Styles */  
        }
    </style>
</head>
<body style="background-color: #353535">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: #272727">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="logo.png" style="width: 200px;height: 50px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="color: #ff6b34" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color: #353535">
                                    <a class="dropdown-item" style="color: #ff6b34; background-color: #353535" href="{{ route('logout') }}"
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
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   
</body>
</html>
