{!! Form::open(['action' => ['AdvisorsController@postGiveAdviceCreate', $advice_request_id], 'method' => 'post']) !!}

{{ Form::label('message', 'Message') }}
{{ Form::textarea('message') }}

{{ Form::label('is_anonymous', 'Anonymous?') }}
{{ Form::checkbox('is_anonymous', 'value', true) }}

<p>
    {{ Form::submit('Give Advice') }}
</p>

{!! Form::close() !!}

