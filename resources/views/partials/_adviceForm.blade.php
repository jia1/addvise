{!! Form::open(['action' => ['AdvisorsController@postGiveAdviceCreate', $advice_request_id], 'method' => 'post']) !!}

{{ Form::label('message', 'Your Advice') }}
{{ Form::textarea('message') }}

{{ Form::label('is_anonymous', 'Stay anonymous?') }}
{{ Form::checkbox('is_anonymous', true, true) }}

<p class="commets">
    {{ Form::submit('Give Advice') }}
</p>

{!! Form::close() !!}

