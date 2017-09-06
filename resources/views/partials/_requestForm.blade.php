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

    'Academics' => [
        1 => 'Academics',
        2 => 'Internships',
        3 => 'Overseas',
    ],
    'Career' => [
        4 => 'Certification',
        5 => 'Companies',
        6 => 'Interviews',
    ],
    'Personal' => [
        7 => 'Finances',
        8 => 'Health',
        9 => 'Lifestyle',
    ],
    'Social' => [
        10 => 'Bullying',
        11 => 'Family',
        12 => 'Friendships',
        13 => 'Relationships',
    ],

    ]) }}
</p>

<p>
{{ Form::label('message', 'Your message') }}
{{ Form::textarea('message', null, ['placeholder' => 'What advice do I need...?']) }}
</p>

<div class = "row" style = "display:inline;">
{{ Form::label('is_anonymous', 'Stay anonymous?') }}
{{ Form::checkbox('is_anonymous', true, true) }}
</div>

<p>
{{ Form::submit('#needAddvise') }}
</p>

{!! Form::close() !!}

