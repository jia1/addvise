@extends('main')

@section('title', 'Give')

@section('scripts')
<script>
    function submitAction() {
        alert('Your advice is up! One good deed a day keeps the doctor away!');
    }
</script>
@stop

@section('content')
<!-- Wrapper -->
<div id="wrapper">

<!-- Main -->
<div id="main">

    <!-- Answer Section -->
    <section id="answer" class="main special">
        <header class="major">
            <h2>Give an Advice</h2>
        </header>
        @include('partials._adviceForm')
    </section>

</div>
</div>
@stop

