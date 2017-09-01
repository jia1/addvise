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
    </head>
    <body>

        <!-- Wrapper -->
            <div id="wrapper">

                <!-- Header -->
                    <header id="header" class="alt">
                        <span class="logo"><img src="img/addvise-icon.png" alt="" /></span>
                        <h1>Addvise</h1>
                        <p>Seek Advice, Give Advice.</p>
                    </header>

                <!-- Nav -->
                    <nav id="nav">
                        <ul>
                            <li><a href="#ask" class="active">Ask</a></li>
                            <li><a href="#answer">Answer</a></li>
                        </ul>
                    </nav>

                <!-- Main -->
                    <div id="main">

                        <!-- Ask Section -->
                            <section id="ask" class="main special">
                                <div class="spotlight">
                                    <div class="content">
                                        <header class="major">
                                            <h2>Request for Advice</h2>
                                        </header>
                                        <ul class="actions">
                                            <select>
                                            <option value="" disabled selected hidden>Select Category</option>
                                            <option value="volvo">Education</option>
                                            <option value="saab">Healthcare</option>
                                            <option value="opel">Ageing</option>
                                            <option value="audi">Technology</option>
                                            <option value="audi">Relationships</option>
                                            <option value="audi">Others</option>
                                            </select> <br>
                                            <input type="text" name="request"><br>
                                            <input type="submit" value="Submit" onclick = "return submitAction();">
                                        </ul>
                                    </div>
                                </div>
                            </section>

                        <!-- Answer Section -->
                            <section id="answer" class="main special">
                                <header class="major">
                                    <h2>Give Advice</h2>
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
                                 <center><div class="fb-page" data-href="https://www.facebook.com/addvise/" data-tabs="timeline" data-width="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/addvise/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/addvise/">Addvise</a></blockquote></div></center>
                                 <div class="row">
                                    <div class="6u 12u(narrower)">
                                        <section class="box special">
                                            <p>01/10/2017</p>
                                            <p>I need advice...</p>
                                            <p>4 comments</p>
                                            <input type="text" name="answer"><br>
                                            <input type="submit" value="Comment" onclick = "return submitAction();">>
                                        </section>
                                    </div>

                                    @foreach(json_decode($advice_requests, true) as $post)
                                    <div class="6u 12u(narrower)">
                                    <section class="box special">
                                        <p>{{ $post['created_time'] }}</p>
                                        <p>{{ $post['message'] }}</p>
                                        <p>{{ $post['comment_count'] }} comments</p>
                                        @foreach($post['comments'] as $comment)
                                            <p>{{ $comment }}</p>
                                        <input type="text" name="answer"><br>
                                        <input type="submit" value="Comment" onclick = "return submitAction();">
                                        
                                    </section>
                                    </div>
                                    @endforeach
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
