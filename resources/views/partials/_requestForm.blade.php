{!! Form::open(['action' => 'AdviseesController@postTakeAdviceCreate', 'method' => 'post']) !!}

{{ Form::label('message', 'Message') }}
{{ Form::textarea('message') }}

{{ Form::label('is_anonymous', 'Anonymous?') }}
{{ Form::checkbox('is_anonymous', 'value', true) }}

<p>
    {{ Form::submit('#needAddvise') }}
</p>

{!! Form::close() !!}

