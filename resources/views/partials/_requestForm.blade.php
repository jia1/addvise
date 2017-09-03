{!! Form::open(['action' => 'AdviseesController@postTakeAdviceCreate', 'method' => 'post']) !!}

{{ Form::select('label', [1 => 'Education', 2 => 'Technology', 3 => 'Ageing', 4 => 'Health']) }} <br>
{{ Form::textarea('message') }} <br>
<p>
    {{ Form::submit('#needAddvise') }}
</p>

{!! Form::close() !!}

