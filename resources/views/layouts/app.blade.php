<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}}</title>

    @yield('topscript')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/res/css/jquery-ui.min.css" rel="stylesheet">
    <link href="/res/css/font-awesome.min.css" rel="stylesheet">
    <style>
        #navimg{
            width: 2rem;
            height: 2rem;
            border-radius: 100%;
        }
    </style>
    @yield('style')
</head>
<body>
    <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel pt-0 pb-0">
                    <div class="container" style="direction: rtl;">
                        @guest
                        @else
                        <a class="navbar-brand" style="font-size:16pt" href="{{ url('/dashboard') }}">
                            الرئيسـيه
                        </a>
                        @endguest
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <!-- Left Side Of Navbar -->
                            @guest
                            @else
                            <ul class="navbar-nav pr-1 ml-auto" style="font-size:15pt;">
                                <li><a class="nav-link" href="/store">المخازن</a></li>
                                <li><a class="nav-link" href="/chart">الاحصائيات</a></li>
                                <li><a class="nav-link" href="/covenant-owner">العهد</a></li>
                                <li><a class="nav-link" href="/users">المستخدمين</a></li>
                            </ul>
                            @endguest
                            <!-- Right Side Of Navbar -->
                            <ul class="navbar-nav mr-auto">
                                <!-- Authentication Links -->
                                @guest
                                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل دخول') }}</a></li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                           <img id="navimg" src="{{isset(Auth::user()->img)?'/uploaded/' . Auth::user()->img:'/img/unknown.png'}}"> {{ Auth::user()->fullname }} <span class="caret"></span>
                                        </a>
        
                                        <div class="dropdown-menu text-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="/profile?id={{Auth::id()}}">الملف الشخصي</a>
                                            <a class="dropdown-item" href="/modify?id={{Auth::id()}}">تعديل</a>
                                            
                                            <a class="dropdown-item" style="border-top:0.05rem solid #f3f3f3;" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('تسجيل خروج') }}
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

        <main id="app">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script src="/res/js/jquery.js"></script>
    <script src="/res/js/jquery-ui.min.js"></script>
    @yield('script')
</body>
</html>
