@extends ('layout')


@section ('content')

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

            </div>
        </div>

@endsenction