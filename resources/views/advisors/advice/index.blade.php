@extends('main')

@section('title', 'Advice and Everything Nice')

@section('content')

@extends('me')

@section('givenAdvice')
<section class="box">
    @foreach(json_decode($all_advice, true) as $message)
    	<p>{{ $message }}</p>
  	@endforeach
</section>
@stop