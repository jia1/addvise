@extends('main')

@section('title', 'Advice and Everything Nice')

@section('content')

@extends('me')

@section('givenAdvice')
<div class="6u 12u(narrower)">
   	<section class="box">
        @foreach(json_decode($all_advice, true) as $message)
        	<p>{{ $message }}</p>
    	@endforeach
    </section>
</div>
@stop