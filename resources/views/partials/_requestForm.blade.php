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
        3 => 'Overseas opportunities',
    ],
    'Career' => [
        4 => 'Certification',
        5 => 'Companies',
        6 => 'Interviews',
        7 => 'Office politics',
        8 => 'Work-life balance',
    ],
    'Personal' => [
        9 => 'Finances',
        10 => 'Health',
        11 => 'Lifestyle',
        12 => 'Personality',
    ],
    'Social' => [
        13 => 'Being different from others',
        14 => 'Bullying',
        15 => 'Family',
        16 => 'Friendships',
        17 => 'Relationships',
    ],

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

