@extends('main')

@section('title', '#needAddvise')

@section('content')

<div class="content">
    @foreach(json_decode($advice_requests, true) as $message)
        <p>{{ $message }}</p>
    @endforeach
</div>

@stop

