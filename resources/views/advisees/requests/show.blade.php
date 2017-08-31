@extends('main')

@section('title', 'My #needAddvise')

@section('content')

<div class="content">
    @foreach(json_decode($advice_requests, true) as $post)
        <p>{{ $post['created_time'] }}</p>
        <p>{{ $post['message'] }}</p>
        <p>Facebook ID: {{ $post['id'] }}</p>
        <p>{{ $post['comment_count'] }} comments</p>
        @foreach($post['comments'] as $comment)
            <p>{{ $comment }}</p>
        @endforeach
    @endforeach
</div>

@stop

