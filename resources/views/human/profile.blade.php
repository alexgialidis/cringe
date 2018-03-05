@extends('layout')

@section('content')
<style>
.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #5cb85c;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #4CAF50;
    cursor: pointer;
}
</style>
<div class="container">
    <div class="row">

        <div class ="col-md-10 col-md-offset-2">
            <div>
                <div class="panel-heading">
                    <h3>My Profile</h3>
                </div>
                <div class="panel-body">
                    <div class="row">


                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information" id="humanData">
                                <tbody>
                                    <tr>
                                        <td>First Name:</td>
                                        <td>{{ $human->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Last Name:</td>
                                        <td>{{ $human->surname }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $human->city }}, {{ $human->address }} {{ $human->number }}</td>
                                    </tr>

                                    <tr>
                                        <tr>
                                            <td>Zip</td>
                                            <td>{{ $human->zip }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{ $human->email }}</td>
                                        </tr>

                                        <tr>
                                            <td>Wallet Points</td>
                                            <td>{{ $human->points }}</td>
                                        </tr>
                                    </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Button to Open the Modal -->
<button type="button" class="btn btn-success center-block" data-toggle="modal" data-target="#myModal">
    Add Points
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class= "container-fluid">
            <div class="modal-header">
                <h4 class="modal-title">Add Points</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->

            <div class="slidecontainer">
              <input type="range" min="1" max="200" value="50" class="slider" id="myRange">
              <p>Points: <span id="demo"></span></p>
            </div>

            </div>
            <!-- Modal footer -->

            <div class="modal-footer">
                    <button type="button" class="btn btn-success center-block" data-dismiss="modal" onclick= "addPoints()"><span class="glyphicon glyphicon-piggy-bank"></span> Add Points</button>
            </div>

        </div>
    </div>
</div>


<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}



function addPoints(){
    //alert(slider.value);
    table= document.getElementById("humanData");
    $.get("{{ URL::to('human/addPoints') }}",{points: slider.value},function (data){
        table.deleteRow(6);
        var row = table.insertRow(6);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);

        cell1.innerHTML = "Wallet Points";
        cell2.innerHTML = data.toFixed(2);
    });
}
</script>
@endsection
