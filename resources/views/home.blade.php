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
                                    @foreach(json_decode($advice_requests,true) as $post)
                                    <section class="box">
                                        <div class="blog-header">
                                            <div class="blog-author--no-cover">
                                            <style>
                                                .blog-author--no-cover h3::before {
                                                background: url("img/addvise-icon.png");
                                                background-size: cover;
                                                border-radius: 50%;
                                                content: " ";
                                                display: inline-block;
                                                height: 32px;
                                                margin-right: .5rem;
                                                position: relative;
                                                top: 8px;
                                                width: 32px;
                                                }
                                            </style>
                                                <h3>User Name</h3>
                                            </div>
                                        </div>
                                        <div class="blog-body">
                                            <div class="blog-summary">
                                                <p>{{ $post['message'] }}</p>
                                            </div>
                                            <div class="blog-tags">
                                                <ul>
                                                    <li>category</li>
                                                    <li>{{ $post['created_time'] }}</li>
                                                    <li>{{ $post['comment_count'] }} advice</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="blog-footer">
                                            @foreach($post['comments'] as $comment)
                                            <p class="comments"><b> {{ $comment }}</p>
                                            @endforeach
                                            <ul><li class="give-advice"><a href="{{ url('give') }}">Give Advice</a></li></ul>
                                        </div>
                                    </section>
                                    @endforeach
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

    </body>
</html>
@stop
