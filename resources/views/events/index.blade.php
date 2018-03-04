@extends ('layout')

@section ('content')
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script>

var map;
var coords = [];
var markers = [];
var zoom= {{ $zoom }};

function storeCoord(id, lat, lng, title){
    coords.push({id: id, lat:lat, lng: lng, title: title});
}

function initMap() {
    var initPos= {lat: {{ $latlng['lat'] }}, lng: {{ $latlng['lng'] }}};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        center: initPos
    });
    if (zoom ==15){
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
    }
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
        map.setZoom(15);
        map.setCenter(marker.getPosition());
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

<!-- code for the search bar -->
<div class="container">
	<div class="row">
		<div class="col-md-12">
            <div class="input-group" id="adv-search">
                <input type="text" class="form-control" placeholder="Search for snippets" />
                <div class="input-group-btn">
                    <div class="btn-group" role="group">
                        <div class="dropdown dropdown-lg">
                            <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button> -->
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <form class="form-horizontal" role="form">
                                  <div class="form-group">
                                    <label for="filter">Filter by</label>
                                    <select class="form-control">
                                        <option value="0" selected>All Snippets</option>
                                        <option value="1">Featured</option>
                                        <option value="2">Most popular</option>
                                        <option value="3">Top rated</option>
                                        <option value="4">Most commented</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Author</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                  <div class="form-group">
                                    <label for="contain">Contains the words</label>
                                    <input class="form-control" type="text" />
                                  </div>
                                  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </form>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>
          </div>
        </div>
	</div>

    <style media="screen">
    body {
padding-top: 50px;
}
.dropdown.dropdown-lg .dropdown-menu {
margin-top: -1px;
padding: 6px 20px;
}
.input-group-btn .btn-group {
display: flex !important;
}
.btn-group .btn {
border-radius: 0;
margin-left: -1px;
}
.btn-group .btn:last-child {
border-top-right-radius: 4px;
border-bottom-right-radius: 4px;
}
.btn-group .form-horizontal .btn[type="submit"] {
border-top-left-radius: 4px;
border-bottom-left-radius: 4px;
}
.form-horizontal .form-group {
margin-left: 0;
margin-right: 0;
}
.form-group .form-control:last-child {
border-top-left-radius: 4px;
border-bottom-left-radius: 4px;
}

@media screen and (min-width: 768px) {
#adv-search {
    width: 500px;
    margin: 0 auto;
}
.dropdown.dropdown-lg {
    position: static !important;
}
.dropdown.dropdown-lg .dropdown-menu {
    min-width: 500px;
}
}
    </style>
<!-- end of the search bar code -->
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

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDExc4GNJctRKQDUNuYvUm6CtUVXid8eVo&callback=initMap">
</script>
@endsection
