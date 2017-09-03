@extends('main')

@section('title', 'Home')

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
    </head>
    <body>

        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Header -->
                    <header id="header" class="alt">
                        <span class="logo"><img src="img/addvise-icon.png" alt="" /></span>
                        <h1>Addvise</h1>
                        <p>Seek Advice, Give Advice.</p>
                        <div class="fb-like" data-href="https://facebook.com/addvise" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="true"></div>
                    </header>

               
            </div>
            

         <!-- Wrapper -->
            <div id="wrapper">

                <!-- Main -->
                    <div id="main">

                        <!-- Show All Advice -->
                            <section id="answer" class="main special">
                                <header class="major">
                                    <h2>View Advices</h2>
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
                                @yield('allAdvice')
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
