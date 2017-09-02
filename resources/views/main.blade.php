<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <link rel="stylesheet" href="/css/popout.css" />
    </head>
    <body>
        @include('partials._facebook')
        <div class="flex-center position-ref full-height">
            @include('partials._nav')
            @yield('content')
            @include('partials._footer')
        </div>

        <!--POPUP-->
        <div id="nojs" class="overlay light">
        <a class="cancel" href="#"></a>
        <div class="nojscontent">
            <h2>You need to turn on your JavaScript to access Addvise.</h2>
        </div>

        <!-- SCRIPT TO CHECK IF JAVASCRIPT EXISTS -->
        <noscript>
            <style type="text/css">
                .pagecontainer {display:none;}
            </style>
            <div class="noscriptmsg">
                <!-- JAVASCRIPT BLOCKED -->
                <meta http-equiv="refresh" content="2; url=./#nojs" />
            </div>
        </noscript>
    </body>
</html>