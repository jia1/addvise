@extends('main')

@section('title', 'Give an Advice')

@section('content')

<p>You are giving an advice to:</p>

<p>
    {{ $advice_request_message }}
</p>

@include('partials._adviceForm')

@stop

