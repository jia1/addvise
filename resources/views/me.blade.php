@extends('main')

@section('title', 'Me')

@section('content')
<!--
    Stellar by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>Addvise</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
        <link rel="stylesheet" href="/css/main.css" />
        <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
        <!-- Global Site Tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-105785707-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments)};
        gtag('js', new Date());

        gtag('config', 'UA-105785707-1');
        </script>
    </head>
    <body>

        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Main -->
                    <div id="main">

                        <!-- Me Section -->
                            <section id="me" class="main special">
                                <header class="major">
                                    <h2>Given Advice</h2>
                                </header>
                                <select>
                                            <option value="" disabled selected hidden>Select Category</option>
                                            <option value="volvo">Education</option>
                                            <option value="saab">Healthcare</option>
                                            <option value="opel">Ageing</option>
                                            <option value="audi">Technology</option>
                                            <option value="audi">Relationships</option>
                                            <option value="audi">Others</option>
                                            </select> <br>


                                <div class="row">
                                @yield('givenAdvice')
                                </div>

                            </section>
                    </div>

            </div>

        <!-- Scripts -->
            <script src="/js/jquery.min.js"></script>
            <script src="/js/jquery.scrollex.min.js"></script>
            <script src="/js/jquery.scrolly.min.js"></script>
            <script src="/js/skel.min.js"></script>
            <script src="/js/util.js"></script>
            <script src="/js/main.js"></script>
            <script>
            function submitAction(){
                alert('Request posted successfully!');
                var req = document.getElementsByName("request")[0];
                req.value = "";
                $('select').prop('selectedIndex', 0);
            }
            </script>


    </body>
</html>
@stop