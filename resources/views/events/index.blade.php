@extends ('layout')

@section ('content')
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script>

var map;
var coords = [];
var markers = [];

function storeCoord(id, lat, lng, title){
    coords.push({id: id, lat:lat, lng: lng, title: title});
}

function initMap() {
    var initPos= {lat: {{ $latlng['lat'] }}, lng: {{ $latlng['lng'] }}};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: initPos
    });

    var marker = new google.maps.Marker({
        position: initPos,
        animation: google.maps.Animation.DROP,
        title: "Your Location"
    });
    marker.addListener('click', function() {
    //    map.setZoom(15);
    //    map.setCenter(marker.getPosition());
    //    toggleBounce(-10);
    });
    marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
    marker.setMap(map);
    markers.push({id: -10, marker:marker});

    for (var i = 0; i < coords.length; i++) {
        addMarker(coords[i]);
    }
}

function addMarker(pos){
    var marker = new google.maps.Marker({
        position: pos,
        animation: google.maps.Animation.DROP,
        title: pos.title
    });
    marker.addListener('click', function() {
    //    map.setZoom(15);
    //    map.setCenter(marker.getPosition());
    //toggleBounce(pos.id);
    });
    marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
    marker.setMap(map);
    markers.push({id: pos.id, marker:marker} );
}
function toggleBounce(id) {
    var m;
    for (var i = 0; i < markers.length; i++) {
        if(markers[i].id== id) {
            m= markers[i];
        }else {
            markers[i].marker.setAnimation(null);
        }
    }
    if (m.marker.getAnimation() !== null) {
        m.marker.setAnimation(null);
    } else {
        m.marker.setAnimation(google.maps.Animation.BOUNCE);
    }
    return m;
}

function resetCenter(id){
    var m= toggleBounce(id);
    map.setZoom(15);
    map.setCenter(m.marker.getPosition());
}
</script>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Events</div>
                @foreach ($events as $event)
                <button type="button" class="btn btn-default list-group-item list-group-item-action flex-column align-items-start" onclick="resetCenter({{$event['id']}})">
                    <div class="">
                        <h2><a target="_blank" href="/events/{{ $event['id'] }}" style="font-weight:1000; color:black" >{{ $event['title'] }}</a></h2>
                        <p> <?php
                        $desc = substr($event['description'], 0, 40);
                        echo $desc;
                        ?>

                    </div>
                </button>
                <script type="text/javascript">
                // addMarker(37.9926033,23.75873,"aaaaaa");
                storeCoord({{ $event['id'] }}, {{ $event['lat'] }},{{ $event['long'] }},"{{ $event['title'] }}");
                </script>
                @endforeach
            </div>
        </div>
        <div class="col-md-1" ></div>
        <div class="row">
            <div class="col-md-6">
                <div class="affix col-md-11">
           <div id="map" class="col-md-6" style="height:70vh" ></div>
        </div>
    </div>
    </div>
</div>
</div>
<style media="screen">

@media only screen and (max-width: 900px) {
    .affix {
    position: static;
}
}

</style>

<footer class="footer">
      <div class="container">
        <span class="text-muted">Cringe Team</span>
      </div>
    </footer>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDExc4GNJctRKQDUNuYvUm6CtUVXid8eVo&callback=initMap">
</script>
@endsection
