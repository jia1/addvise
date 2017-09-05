<style>
    input[type="checkbox"] {
        -moz-appearance: checkbox;
        -webkit-appearance: checkbox;
        -ms-appearance: checkbox;
        opacity: 1;
    }
</style>

{!! Form::open(['action' => 'AdviseesController@postTakeAdviceCreate', 'method' => 'post']) !!}

<p>
{{ Form::label('label', 'Type of advice needed') }}
{{ Form::select('label', [
    0 => 'Uncategorized',
    1 => 'Academics',
    2 => 'Health',
    3 => 'Lifestyle',
    4 => 'Relationships',
]) }}
</p>

<p>
{{ Form::label('message', 'Your message') }}
{{ Form::textarea('message', null, ['placeholder' => 'What advice do I need...?']) }}
</p>

<p>
{{ Form::label('is_anonymous', 'Stay anonymous?') }}
{{ Form::checkbox('is_anonymous', true, true) }}
</p>

<p>
{{ Form::submit('#needAddvise') }}
</p>

{!! Form::close() !!}

