@extends ('layout')

@section ('content')
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
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




	<div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading">Events</div>
          @foreach ($events as $event)

          <button type="button" class="btn btn-default list-group-item list-group-item-action flex-column align-items-start" onclick="showMarker('$event['lat']', '$event['long']');">
           <div class="d-flex w-100 justify-content-between event-det">
             <h2><a href="#" style="font-weight:1000; color:black">{{ $event['title'] }}</a></h2>
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