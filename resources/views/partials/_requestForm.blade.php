{!! Form::open(['action' => 'AdviseesController@postTakeAdviceCreate', 'method' => 'post']) !!}

{{ Form::textarea('message') }}
{{Form::label('message', 'Message')}}
<br>
<p>
    {{ Form::submit('#needAddvise') }}
</p>

{!! Form::close() !!}

