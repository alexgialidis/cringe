@extends('layout')

@section ('content')
 

<div class="content col-md-6 col-md-offset-3 vcenter ertical-center">
    <div class="title m-b-md" style="font-weight: 100">
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
@endsection