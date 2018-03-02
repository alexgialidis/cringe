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
            <input type="text" class="form-control" name="search" id="search" placeholder="Search">  
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>

        <div class="form-group">
                <input type="number" class="form-control" name="age" id="age" placeholder="Age">
        </div>

        <div class="form-group">
                <input type="number" class="form-control" name="max_price" id="max_price" placeholder="Maximum Price">
        </div>

        <div class="form-group">
                <input type="number" class="form-control" name="radius" id="radius" placeholder="Radius in kilometers">
        </div>

        <label class="radio-inline">
          <input type="radio" name="location" value="default" checked="checked">Use my default location
        </label>
        <label class="radio-inline">
          <input type="radio" name="location" value="new">Use my current location
        </label>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="display:none">
                    Search
                </button>
            </div>
        </div>
        

    </form> 
</div>

@endsection