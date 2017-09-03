{!! Form::open(['action' => 'AdviseesController@postTakeAdviceCreate', 'method' => 'post']) !!}

{{ Form::select('label', [1 => 'Education', 2 => 'Technology']) }} <br>
{{ Form::textarea('message') }} <br>
<p>
    {{ Form::submit('#needAddvise') }}
</p>

{!! Form::close() !!}

