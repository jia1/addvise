<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Addvise | @yield('title', 'Seek Advice, Give Advice.')</title>
        @include('partials._head')
        @yield('stylesheets')
        @yield('scripts')
    </head>
    <body>
        @include('partials._facebook')

        @if (Session::has('status'))
            {{ Session::get('status') }}
        @endif

        <noscript>
            <style type="text/css">
                .pagecontainer {
                    display: none;
                }
            </style>
            <div class="noscriptmsg">
                <meta http-equiv="refresh" content="0; url=./nojs">
            </div>
        </noscript>

        @include('partials._nav')

        <!-- Wrapper -->
        <div id="wrapper">

        <!-- Header -->
        <header id="header" class="alt">
            <span class="logo"><img src="{{ url('img/addvise-icon.png') }}" alt="Addvise Logo"></span>
                <h1>Addvise</h1>
                <p>Seek Advice, Give Advice.</p>
            <div class="fb-like" data-href="https://facebook.com/addvise"
                data-layout="button_count" data-action="like" data-size="large" data-show-face />
        </header>

        </div>

        @yield('content')
        @include('partials._footer')

    </body>
</html>

