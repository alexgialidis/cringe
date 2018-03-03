@extends ('layout')

@section ('content')
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDExc4GNJctRKQDUNuYvUm6CtUVXid8eVo&libraries=geometry"></script>

<script>
var map;
var coords=[];
function storeCoord(lat, lng, title){
    coords.push({ lat:lat, lng: lng, title: title});
}
  function initMap() {
      var initPos= {lat: {{ $latlng['lat'] }}, lng: {{ $latlng['lng'] }}};
      map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: initPos
      });


      for (var i = 0; i < coords.length; i++) {
          addMarker(coords[i]);
      }
  }

  function addMarker(pos){

      //var pos= {lat: lat, lng: lng}
      var marker = new google.maps.Marker({
         position: pos,
          title: pos.title
      });
      marker.setMap(map);
}

</script>


	<div class="container-fluid">
    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-default">
          <div class="panel-heading">Events</div>
          @foreach ($events as $event)
          <button type="button" class="btn btn-default list-group-item list-group-item-action flex-column align-items-start">
           <div class="d-flex w-100 justify-content-between event-det">
             <h2><a href="/events/{{ $event['id'] }}" style="font-weight:1000; color:black">{{ $event['title'] }}</a></h2>
             <p> <?php
             $desc = substr($event['description'], 0, 40);
             echo $desc;
             ?>

           </div>
          </button>
          <script type="text/javascript">
            // addMarker(37.9926033,23.75873,"aaaaaa");
             storeCoord({{ $event['lat'] }},{{ $event['long'] }},"{{ $event['title'] }}");
          </script>
           @endforeach
         </div>
       </div>
       <div class="col-md-1" ></div>
       <div id="map" class="col-md-5 col-sd-5 fixed" style="height:70vh"></div>
     </div>
   </div>

   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDExc4GNJctRKQDUNuYvUm6CtUVXid8eVo&callback=initMap">
    </script>
   @endsection
