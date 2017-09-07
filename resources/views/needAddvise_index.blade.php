@extends('main')

@section('title', 'Latest #needAddvise')

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
        <h2>Latest #needAddvise</h2>
    </header>

    @foreach(json_decode($advice_requests, true) as $post)
    <section class="box">
        <div class="blog-header">
            <div class="blog-author--no-cover">
                @if (! $post['fb_user_id'])
                    <h3>Addvise</h3>
                @else
                    <h3 class="fb-user-id">{{ $post['fb_user_id'] }}</h3>
                @endif
            </div>
        </div>
        <div class="blog-body">
            <div class="blog-summary">
                <p>{{ $post['message'] }}</p>
            </div>
            <div class="blog-tags">
                <ul>
                    <li class="label">{{ $post['label'] }}</li>
                    <li>{{ $post['created_time'] }}</li>
                    <li>{{ $post['comment_count'] }} advice</li>
                </ul>
            </div>
        </div>
        <div class="blog-footer">
        @foreach($post['comments'] as $comment)
            <p class="comments">
                <span style="color:gray;">
                @if (! $comment['fb_user_id'])
                    Addvise:
                @else
                    <span class="fb-user-id">{{ $comment['fb_user_id'] }}</span>:
                @endif
                </span>
                <b> {{ $comment['message'] }}</b>
            </p>
        @endforeach
        <ul>
            <li class="give-advice"><a href="{{ url('https://facebook.com/' . $post['fb_post_id']) }}" target="_blank">View on Facebook</a></li>

            @if (! $post['advice_request_id'])
            @else
                <li class="give-advice"><a href="{{ url('needAddvise/' . $post['advice_request_id'] . '/advice/new') }}">Give Advice</a></li>
            @endif
        </ul>
        </div>
    </section>
    @endforeach
    </section>
    
</div>
</div>

<script src="/js/translate.js"></script>
@stop

