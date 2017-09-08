<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Addvise | @yield('title', 'Seek Advice, Give Advice.')</title>
        <link href="img/addvise-icon-square.png" rel="shortcut icon" type="image/x-icon" />

        @include('partials._head')
        @yield('stylesheets')
        @yield('scripts')
    </head>
    <body>
        @include('partials._facebook')

        @if (Session::has('success'))
        <script>
        swal(
            'Success',
            "{{ Session::get('success') }}",
            'success'
        );
        </script>
        @endif

        @if (Session::has('error'))
        <script>
        swal(
            'Error',
            "{{ Session::get('error') }}",
            'error'
        );
        </script>
        @endif

        @if (Session::has('cooldown'))
        <script>
        swal(
            'No spamming please!',
            "{{ Session::get('cooldown') }}",
            'warning'
        );
        </script>
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
                <br><br>
            <div class="fb-like" data-href="https://facebook.com/addvise"
                data-layout="button_count" data-action="like" data-size="large" data-show-face />
        </header>

        </div>

        @yield('content')
        @include('partials._footer')

    </body>
</html>

