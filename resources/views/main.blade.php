<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <body>
        @include('partials._facebook')
        <div class="flex-center position-ref full-height">
            @include('partials._nav')
            @yield('content')
            @include('partials._footer')
        </div>
    </body>
</html>

