@extends('main')

@section('title', 'Give an Advice')

@section('content')

@extends('give')

@section('giveAdvice')

<section class="box">
	<p class="request">You are giving an advice to:</p>
	<p class="request">{{ $advice_request_message }}</p>
	@include('partials._adviceForm')
</section>

@stop

