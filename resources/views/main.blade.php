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

        <!-- SCRIPT TO CHECK IF JAVASCRIPT EXISTS -->
        <noscript>
            <style type="text/css">
                .pagecontainer {display:none;}
            </style>
            <div class="noscriptmsg">
                <!-- JAVASCRIPT BLOCKED -->
                <meta http-equiv="refresh" content="0; url=./nojs" />
            </div>
        </noscript>
    </body>
</html>