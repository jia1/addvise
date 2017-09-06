<style>
input[type="checkbox"] {
    -moz-appearance: checkbox;
    -webkit-appearance: checkbox;
    -ms-appearance: checkbox;
    opacity: 1;
}
</style>

{!! Form::open(['action' => ['AdvisorsController@postGiveAdviceCreate', $advice_request_id], 'method' => 'post']) !!}

<p>
{{ Form::label('message', 'Your Advice') }}
{{ Form::textarea('message') }}
</p>

<div class = "row" style = "display:inline;">
{{ Form::label('is_anonymous', 'Stay anonymous?') }}
{{ Form::checkbox('is_anonymous', true, true) }}
</div>

<p class="comments">
    {{ Form::submit('Give Advice') }}
</p>

{!! Form::close() !!}

