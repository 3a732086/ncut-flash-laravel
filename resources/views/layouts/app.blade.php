<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>

    @toastr_js
    <!-- Toastr js -->
    <!-- <script src="{{asset('js/toastr.js')}}"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/5.5.55/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/jquery.scrolling_tabs.min.css') }}" rel="stylesheet">

    @toastr_css
    <!-- toast CSS -->
    <!-- <link rel="stylesheet" href="{{asset('css/toastr.css')}}"> -->
    @guest
    @else
    @if(Auth::user()->role == 1)
    <style>
    *{
        -webkit-touch-callout:none;  /*系統預設選單被禁用*/
        -webkit-user-select:none; /*webkit瀏覽器*/
        -khtml-user-select:none; /*早期瀏覽器*/
        -moz-user-select:none;/*火狐*/
        -ms-user-select:none; /*IE10*/
        user-select:none;
    }
    input,textarea {
        -webkit-user-select:auto; /*webkit瀏覽器*/
        margin: 0px;
        padding: 0px;
        outline: none;
    }
    </style>
    @endif
    @endguest
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    English Online
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Auth::user()->role == 1)
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('user_show')}}">檢視所有資料</a>
                                    </li>
                                </ul>
                            @elseif (Auth::user()->role == 2)
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('admin_show')}}">檢視所有資料</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('ctr_show')}}">點擊率</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('user_activity')}}">活動紀錄</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('quiz_show')}}">小考分數</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            考試/練習 <span class="caret"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('test') }}">考試區(黃)</a>
                                            <a class="dropdown-item" href="{{ route('test_green') }}">考試區(綠)</a>
                                            <a class="dropdown-item" href="{{ route('test_blue') }}">考試區(藍)</a>
                                            <a class="dropdown-item" href="{{ route('menu') }}">練習區(黃)</a>
                                            <a class="dropdown-item" href="{{ route('menu_green') }}">練習區(綠)</a>
                                            <a class="dropdown-item" href="{{ route('menu_blue') }}">練習區(藍)</a>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/home') }}">Home</a>
                                    @if(Auth::user()->role == 2)
                                        <a class="dropdown-item" href="{{route('setting.index')}}">Setting</a>

                                    @endif
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
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="footer">
        <div class="container text-center">
            <span class="text-muted">COPYRIGHT BY NCUT IM CHUN LIN</span>
        </div>
    </footer>
    @guest
    @else
    @if(Auth::user()->role == 1)
        <script type="text/javascript">
            document.oncontextmenu=new Function("event.returnValue=false");
            document.onselectstart=new Function("event.returnValue=false");
        </script>
    @endif
    @endguest
    <script src="{{asset('js/jquery.scrolling-tabs.min.js')}}"></script>
</body>

@toastr_render
</html>
