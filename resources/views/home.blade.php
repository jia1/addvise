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
            <h2>Addvise Stats</h2>
        </header>

        <p> 
            <i> Number of requests for advice in the last 5 minutes: </i> 
            <div class = "value"> {{ $num_recent_advisees }} </div> <br>
            <i> Registered users: </i> 
            <div class = "value"> {{ $num_users }} </div> <br>
            <i> Total requests for advice: </i> 
            <div class = "value"> {{ $num_advice_requests }} </div> <br>
            <i> Total advice given: </i> 
            <div class = "value"> {{ $num_advice_given }} </div> 
        </p>
    </section>

</div>
</div>
@stop

<style>

p{
    display:inline;
}

i{
    font-size: 20px;
}

.value{
    color: red;
    font-weight: bold;
    display: inline;
    font-size: 20px;
}

</style>
