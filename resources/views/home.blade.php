@extends('main')

@section('title', 'Home')

@section('content')
<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
<div id="main">

    <!-- Me Section -->
    <section id="home" class="main special">
        <header class="major">
            <h2>Home</h2>
        </header>

        <header class="major">
            <h3>Addvise Stats</h3>
        </header>

        <p>Number of requests for advice in the last 5 minutes: {{ $num_recent_advisees }}</p>
        <p>Registered users: {{ $num_users }}</p>
        <p>Total requests for advice: {{ $num_advice_requests }}</p>
        <p>Total advice given: {{ $num_advice_given }}</p>
    </section>

</div>
</div>
@stop

