@extends('main')

@section('title', 'Advice and Everything Nice')

@section('content')

<div class="content">
    @foreach(json_decode($all_advice, true) as $message)
        <p>{{ $message }}</p>
    @endforeach
</div>

@stop

