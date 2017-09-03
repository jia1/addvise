@extends('main')

@section('title', '#needAddvise')

@section('content')

@extends('show')

@sections('allAdvice')

@foreach(json_decode($advice_requests, true) as $post)
<div class="6u 12u(narrower)">
    <section class="box">
        <p class="date">{{ $post['created_time'] }}</p>
        <p>Facebook ID: {{ $post['id'] }}</p>
        <p class="request">{{ $post['message'] }}</p>
        <p class="numofcomments">{{ $post['comment_count'] }} 4 comments</p>

        <ul>
        @foreach($post['comments'] as $comment)
        <li class="comments">{{ $comment }}</li>
        @endforeach
        </ul>
        <div class="giveadvice">
            <input type="submit" value="Comment" onclick = "return submitAction();">
        </div>
    </section>
</div>
@endforeach

@stop

