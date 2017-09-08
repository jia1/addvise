@extends('main')

@section('title', 'Me')

@section('content')
<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
<div id="main">

    <!-- Me Section -->
    <section id="me" class="main special">
        <header class="major">
            <div id="profilePic"></div>
            <h2>
                <div id="userName"></div>
            </h2>
        </header>

        <header class="major">
            <h3>My Stats</h3>
        </header>

        <p>Total requests for advice by me: {{ $num_advice_requests }}</p>
        <p>Total advice given by me: {{ $num_advice_given }}</p>
    </section>

</div>
</div>
@stop

