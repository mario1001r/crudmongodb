<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php 
    $themes = \App\Models\Theme::get();
    $theme_select = Illuminate\Support\Facades\Session::get('theme') != '' ? Illuminate\Support\Facades\Session::get('theme') : 'cosmo';
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    {{--<link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">--}}
    <title>@yield('title_page')</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('bootswatch/dist/' . $theme_select . '/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-free-6.4.2-web/css/all.css') }}">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    @yield('styles')
    <!-- Scripts -->
    {{--@vite(['resources/sass/app.scss', 'resources/js/app.js'])--}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                Catalogos
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/admin/countries') }}">
                                        Países
                                    </a>
                                </li>
                                <li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @lang('generals.bootswatch_theme')
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($themes as $theme)
                                <li>
                                    <a class="dropdown-item" href="{{ url('/setTheme/'.$theme->id) }}">
                                       {{ucfirst($theme->name)}} 
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                @lang('generals.languages')
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/setLang/es') }}">
                                        <img src="{{ asset('imgs/flags/008-mexico.png') }}"
                                            width="30%" height="25%" />
                                        @lang('generals.spanish')
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ url('/setLang/en') }}">
                                        <img src="{{ asset('imgs/flags/067-united-states.png') }}"
                                            width="30%" height="25%" />
                                        @lang('generals.english')
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/login')}}">Acceder</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->partner->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('/profile/user')}}">
                                        @if(Auth::user()->partner->photo != '' && Storage::disk('users_profile_imgs')->exists(Auth::user()->partner->photo))
                                            <img src="{{url('/getImageProfileUser/'.Auth::user()->partner->photo)}}" width="20px" height="20px" class="img-circle" />
                                        @else
                                            <?php $url_img = '';?>
                                            @if(Auth::user()->partner->sex == 'male')
                                                <?php $url_img = '/getImageProfileUser/avatar_man.png';?>
                                            @else
                                                <?php $url_img = '/getImageProfileUser/avatar_women.png';?>
                                            @endif 
                                            <img src="{{url($url_img)}}" width="20px" height="20px" class="img-circle" />
                                        @endif
                                        @lang('generals.profile_of') {{Auth::user()->partner->first_name}}
                                    </a>
                                    <a class="dropdown-item" href="{{url('/profile/user/password')}}">
                                         @lang('generals.password_change')
                                    </a>
                                    <a class="dropdown-item" href="{{url('/profile/user/settings')}}">
                                        @lang('generals.generals_preferences')
                                   </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> @lang('generals.logout')
                                    </a>

                                    <form id="logout-form" action="{{url('/logout')}}" method="POST" class="d-none">
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
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <p id="alert_success2" class="alert alert-success text-center" id="alert_success" style="font-size:20px;display:none;"></p>
                    @if (Session::has('message'))
                        <p class="alert alert-success text-center" id="alert_success" style="font-size:20px;">
                            {!! Session::get('message') !!}
                        </p>
                    @endif
                </div>
                <div class="col-lg-3"></div>
            </div>
            <div class="container">
                <div class="row">
                    <h5>@yield('title')</h5>
                </div>
                <div class="row">
                    <div class="col-lg-9">
                        @yield('buttons')
                    </div>
                    <div class="col-lg-3 pull-right">
                        @yield('delete_button')
                    </div>
                </div>
                <br>
                @yield('content')
            </div>
        </main>
    </div>
    <!-- Scripts -->
    <!-- Start Scripts selectpicker -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!-- End Scripts selectpicker -->
    <script>
        var message = "{{ Session::get('message') }}";
        if (message != null) {
            setTimeout(function() {
                $('#alert_success').hide('low');
            }, 6000);
        }
    </script>
    @yield('scripts')
</body>
</html>
