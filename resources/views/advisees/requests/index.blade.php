@extends('main')

@section('title', '#needAddvise')

@section('content')

@foreach(json_decode($advice_requests,true) as $post)
<div class="6u 12u(narrower)">
    <section class="box">
        <p class="date">{{ $post['created_time'] }}</p>
        <p class="facebookid">Facebook ID: {{ $post['id'] }}</p>
        <p class="request">{{ $post['message'] }}</p>
        <p class="numofcomments">{{ $post['comment_count'] }} comments</p>

        <ul>
        @foreach($post['comments'] as $comment)
        <li class="comments">{{ $comment }}</li>
        @endforeach
        </ul>
        <input type="button" onclick="location.href='{{ url('give') }}';" value="Give Advice" /> 
    </section>
</div>
@endforeach

@stop

