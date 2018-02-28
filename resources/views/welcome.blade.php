@extends ('layout')


@section ('content')

@if (Auth::guard('human')->user())
<h1>hhhhhhhhhhhhhhhhhhhhhhhhh</h1>
@endif

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
        @auth
        <a href="{{ url('/home') }}">Home</a>
        @else
        <a href="{{ route('login') }}">Login</a>
        <!-- <a href="{{ route('register') }}">Register</a> -->


        <div class="dropdown" style="float:right;">
          <button class="dropbtn">Register</button>
          <div class="dropdown-content">
            <a href="{{ url('/provider/register') }}">Provider</a>
            <a href="{{ url('/human/register') }}">Parent</a>
        </div>
    </div>
    @endauth
</div>
@endif

<div class="content">
    <div class="title m-b-md">
        Cringe
    </div>

    <form method="GET" action="/events/search" class="search-form">
        <!-- {{ csrf_field() }} -->
        <div class="form-group has-feedback">
            <label for="search" class="sr-only">Search</label>
            <input type="text" class="form-control" name="search" id="search" placeholder="search">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
    </form> 
</div>



</div>

@endsection