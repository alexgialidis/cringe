@extends ('layout')

@section ('content')
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyyd0zM6OUe4PflYQ1_BD-feq3omU9zK0&libraries=geometry"></script>
<script>

      // The following example creates a marker in Stockholm, Sweden using a DROP
      // animation. Clicking on the marker will toggle the animation between a BOUNCE
      // animation and no animation.

      var marker;

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 59.325, lng: 18.070}
        });

        marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: {lat: 59.327, lng: 18.067}
        });
        marker.addListener('click', toggleBounce);
      }

      function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }

      }
</script>

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
</script>



	<div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading">Events</div>
          @foreach ($events as $event)
          <button type="button" class="btn btn-default list-group-item list-group-item-action flex-column align-items-start" onclick="showMarker('$event['lat']', '$event['long']');">
           <div class="d-flex w-100 justify-content-between event-det">
             <h2><a href="/events/{{ $event['id'] }}" style="font-weight:1000; color:black">{{ $event['title'] }}</a></h2>
             <p> <?php 
             $desc = substr($event['description'], 0, 40);
             echo $desc;
             ?>

           </div>  
          </button>
           @endforeach
         </div>
       </div>
       <div class="col-md-1"></div>
       <div id="map_canvas" class="col-md-5 col-sd-5" style="height:70vh"></div>
     </div>
   </div>

   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyyd0zM6OUe4PflYQ1_BD-feq3omU9zK0&callback=initMap">
    </script>
   @endsection