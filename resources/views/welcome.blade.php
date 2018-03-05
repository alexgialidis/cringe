@extends('layout')

@section ('content')

<script type="text/javascript">

function getLoc(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(setPos);
    } else {
        //document.getElementById("new").style.color = "red";
    }
}

function setPos(position){
    document.getElementById("lat").value = position.coords.latitude;
    document.getElementById("lng").value = position.coords.longitude;
    //alert(document.getElementById("lat").value + "," + document.getElementById("lng").value);
}
</script>


<div class="content col-md-6 col-md-offset-3 vcenter ertical-center">
    <div class="title m-b-md" style="font-weight: 100">
        Cringe
    </div>

    <form method="GET" action="/events/search" class="search-form">
        <!-- {{ csrf_field() }} -->

    <div id= "big">
        <div class="form-group has-feedback">
            <label for="search" class="sr-only">Search</label>
            <input type="text" class="form-control" name="search" id="search" placeholder="Search" autocomplete="off">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>


        <div id="filters" style="display: none;">

            <div class="form-group">
                    <input type="number" class="form-control" name="age" id="age" placeholder="Age" autocomplete="off">
            </div>

            <div class="form-group">
                    <input type="number" class="form-control" name="max_price" id="max_price" placeholder="Maximum Price" autocomplete="off">
            </div>

            <div class="form-group">
                    <input type="number" class="form-control" name="radius" id="radius" placeholder="Radius in kilometers e.g. 5" autocomplete="off">
            </div>

        </div>
    </div>
<!-- @if (Auth::guard('human')->user())
        <label class="radio-inline">
          <input type="radio" name="location" value="default" checked="checked">Use my default location
        </label>
@endif -->
        <label class="checkbox-inline">
          <input type="checkbox" name="location" value="new" id= "new" onclick= "getLoc()" >Use my current location
        </label>

        <div class="form-group">
                <input class="form-control" name="lat" id="lat" style="display:none">
        </div>
        <div class="form-group">
                <input class="form-control" name="lng" id="lng" style="display:none">
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="display:none">
                    Search
                </button>
            </div>
        </div>


    </form>
</div>

<script type="text/javascript">

    $(document).on('click','body',function(){
        //alert(document.activeElement.tagName);
        if (document.activeElement.tagName == "INPUT"){
            document.getElementById("filters").style.display= "block";
        }
        else{
            document.getElementById("filters").style.display= "none";

        }
    });

</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


@endsection
