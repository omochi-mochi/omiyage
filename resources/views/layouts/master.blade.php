<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@yield('title')</title>
        
        <!-- Scripts -->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <script src="{{ secure_asset('js/master.js') }}" defer></script>
        @stack('scripts')
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
        <!-- Styles -->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/master.css') }}" rel="stylesheet">
        @stack('css')
        
    </head>
    <body>
        <header class="header">
            <a class="omiyage_logo" href="{{ url('/') }}">
                <img src="" alt="omiyage" width="60" height="20">
            </a>
                <nav class="global-nav">
                <ul class="global-nav__list">
                    <li class="global-nav__item"><a href="{{ url('userpages/mypage') }}">マイページ</a></li>
                    <li class="global-nav__item"><a href="{{ url('page/create') }}">新規記事作成</a></li>
                    <li class="global-nav__item">
                        @guest
                            <a href="{{ route('login') }}">ログイン</a>
                        @else
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                               ログアウト
                            </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    
                </ul>
                </nav>
            <div class="hamburger" id="js-hamburger">
                <span class="hamburger__line hamburger__line--1"></span>
                <span class="hamburger__line hamburger__line--2"></span>
                <span class="hamburger__line hamburger__line--3"></span>
            </div>
            <div class="black-bg" id="js-black-bg"></div>
        </header>
        
        
        <main class="py-4">
                @yield('content')
        </main>
        
    <footer class="footer">
        
    </footer>
    </body>
    
    
</html>
