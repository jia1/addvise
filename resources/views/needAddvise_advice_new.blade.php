@extends('main')

@section('title', 'Ask')

@section('scripts')
@stop

@section('content')
<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
<div id="main">

    <!-- Ask Section -->
    <section id="ask" class="main special">
        <div class="spotlight">
            <div class="content">
                <header class="major">
                    <h2>Give an Advice</h2>
                </header>

                <section class="box">
                    <p class="request">You are giving an advice to:</p>
                    <p class="request">{{ $advice_request_message }}</p>
                    @include('partials._adviceForm')
                </section>
            </div>
        </div>
    </section>

</div>
</div>
@stop

