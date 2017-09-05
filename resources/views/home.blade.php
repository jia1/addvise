@extends('main')

@section('title', 'Feed')

@section('stylesheets')
<link rel="stylesheet" href="/css/author.css">
@stop

@section('content')
<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
<div id="main">

    <!-- Show All Advice -->
    <section id="answer" class="main special">
    <header class="major">
        <h2>Advice Wanted Here</h2>
    </header>

    @foreach(json_decode($advice_requests, true) as $post)
    <section class="box">
        <div class="blog-header">
            <div class="blog-author--no-cover">
                <h3>Addvise</h3>
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
        <ul>
            <li class="give-advice"><a href="{{ url('give') }}">Give Advice</a></li>
        </ul>
        </div>
    </section>
    @endforeach
    </section>
    
</div>
</div>
@stop

