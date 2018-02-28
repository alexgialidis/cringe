@extends ('layout')

@section ('content')
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
  <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxSPW5CJgpdgO_s4yyMovOaVh_KvvhSfpvagV18eOyDWu7VytS6Bi1CWxw"
  type="text/javascript"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script type="text/javascript">
        var map = null;
        var geocoder = null;


        function showAddress(address) {
          if (geocoder) {
            geocoder.getLatLng(
              address,
              function(point) {
                if (!point) {
                  alert(address + " not found");
                } else {
                  map.setCenter(point, 15);
                  var marker = new GMarker(point, {draggable: true});
                  map.addOverlay(marker);
                  GEvent.addListener(marker, "dragend", function() {
                    marker.openInfoWindowHtml(marker.getLatLng().toUrlValue(6));
                  });
                  GEvent.addListener(marker, "click", function() {
                    marker.openInfoWindowHtml(marker.getLatLng().toUrlValue(6));
                  });
                  GEvent.trigger(marker, "click");
                }
              }
              );
          }
        }

        function initialize() {
          map = new GMap2(document.getElementById("map_canvas"));
          map.setCenter(new GLatLng(37.984165, 23.729449), 10);      map.setUIToDefault();
          geocoder = new GClientGeocoder();
          getLocation();
        }
        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showOnMap);
          } else { 
            x.innerHTML = "Geolocation is not supported by this browser.";
          }
        }


        function showOnMap(position){
          map = new GMap2(document.getElementById("map_canvas"));
          map.setCenter(new GLatLng(position.coords.latitude, position.coords.longitude), 15);
          map.setUIToDefault();
          geocoder = new GClientGeocoder();
        }


      </script>

    <body onload="initialize()" onunload="GUnload()">




	<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>
                @foreach ($events as $event)
                
                <button type="button" class="btn btn-default list-group-item list-group-item-action flex-column align-items-start">
	            <div class="d-flex w-100 justify-content-between event-det">
	                <h2><a href="#" style="font-weight:1000; color:black">{{ $event['title'] }}</a></h2>
					<p> <?php 
						$desc = substr($event['description'], 0, 40);
						echo $desc;
					 ?>
	                <small class="text-muted">3 days ago</small>
	                <small class="text-muted"><br>Show on map</small>     
	              </div>  

                @endforeach
            </div>
        </div>
        <div class="col-md-1"></div>
      <div id="map_canvas" class="col-md-5 col-sd-5" style="height:70vh"></div>
    </div>
</div>
@endsection