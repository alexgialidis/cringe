@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Parent's Data</div>

                <div class="panel-body">
                    <table class= "table table-bordered table-striped table-condensed text-center" id= "humantable">
                        <thread>
                            <tr>
                                <th class= "text-center">Id</th>
                                <th class= "text-center">First Name</th>
                                <th class= "text-center">Last Name</th>
                                <th class= "text-center">Email</th>
                                <th class= "text-center">Actions</th>
                            </tr>
                        </thread>
                        <tbody id="humansdata">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Provider's Data</div>

                <div class="panel-body">
                    <table class= "table table-bordered table-striped table-condensed text-center" id= "providertable">
                        <thread>
                            <tr>
                                <th class= "text-center">Id</th>
                                <th class= "text-center">First Name</th>
                                <th class= "text-center">Last Name</th>
                                <th class= "text-center">Email</th>
                                <th class= "text-center">Actions</th>
                            </tr>
                        </thread>
                        <tbody id="providersdata">


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

$(document).ready(function() {
    loadHumansData();
    loadProvidersData();
})

function loadHumansData(){
        $.get("{{ URL::to('admin/viewdataH') }}",function (data){
            //$("#humansdata").remove();
            $.each(data, function(i,value){
                 var tr= $("<tr/>");
                 tr.append($("<td/>", {
                     text: value.id
                 })).append($("<td/>", {
                     text: value.name
                 })).append($("<td/>", {
                     text: value.surname
                 })).append($("<td/>", {
                     text: value.email
                 }))
                 if (value.lock){
                     tr.append($("<td/>", {
                         html: "<button type='button' class='btn btn-primary btn-sm' onclick= lockHuman('" + value.id +"')> <span class='glyphicon glyphicon-lock'></span> unlock</button>"+
                         " <button type='button' class='btn btn-danger btn-sm' onclick= deleteHuman('" + value.id +"')> <span class='glyphicon glyphicon-trash'></span> Delete</button>"
                     }))
                 }else{
                     tr.append($("<td/>", {
                         html: "<button type='button' class='btn btn-primary btn-sm' onclick= lockHuman('" + value.id +"')> <span class='glyphicon glyphicon-lock'></span> lock</button>"+
                         " <button type='button' class='btn btn-danger btn-sm' onclick= deleteHuman('" + value.id +"')> <span class='glyphicon glyphicon-trash'></span> Delete</button>"
                     }))
                 }
                 //console.log(value.id);

                 $('#humansdata').append(tr);

            })
        })
    }

    function loadProvidersData(){
            $.get("{{ URL::to('admin/viewdataP') }}",function (data){
                //$("#humansdata").remove();
                $.each(data, function(i,value){
                     var tr= $("<tr/>");
                     tr.append($("<td/>", {
                         text: value.id
                     })).append($("<td/>", {
                         text: value.name
                     })).append($("<td/>", {
                         text: value.surname
                     })).append($("<td/>", {
                         text: value.email
                     }))
                     if (value.lock){
                         tr.append($("<td/>", {
                             html: "<button type='button' class='btn btn-primary btn-sm' onclick= lockProvider('" + value.id +"'," + i +")> <span class='glyphicon glyphicon-lock'></span> unlock</button>"+
                             " <button type='button' class='btn btn-danger btn-sm' onclick= deleteProvider('" + value.id +"')> <span class='glyphicon glyphicon-trash'></span> Delete</button>"
                         }))
                     }else{
                         tr.append($("<td/>", {
                             html: "<button type='button' class='btn btn-primary btn-sm' onclick= lockProvider('" + value.id + "')> <span class='glyphicon glyphicon-lock'></span> lock</button>"+
                             " <button type='button' class='btn btn-danger btn-sm' onclick= deleteProvider('" + value.id + "')> <span class='glyphicon glyphicon-trash'></span> Delete</button>"
                         }))
                     }
                     //console.log(value.id);
                     $('#providersdata').append(tr);

                })
            })
        }
    function lockHuman(i,line){
        $.get("{{ URL::to('admin/lockhuman') }}", {id: parseInt(i)},function (data){
            $("#humantable tr").remove();
            var table = document.getElementById("humantable");
            var row = table.insertRow(0);

            var id = row.insertCell(0);
            var name = row.insertCell(1);
            var surname = row.insertCell(2);
            var email = row.insertCell(3);
            var actions = row.insertCell(4);

            id.innerHTML = "<b>Id</b>";
            name.innerHTML = "<b>Name</b>";
            surname.innerHTML = "<b>Surname</b>";
            email.innerHTML = "<b>Email</b>";
            actions.innerHTML = "<b>Actions</b>";
            loadHumansData();
        })
    }
    function lockProvider(i){
        $.get("{{ URL::to('admin/lockprovider') }}", {id: parseInt(i)},function (data){
            $("#providertable tr").remove();
            var table = document.getElementById("providertable");
            var row = table.insertRow(0);

            var id = row.insertCell(0);
            var name = row.insertCell(1);
            var surname = row.insertCell(2);
            var email = row.insertCell(3);
            var actions = row.insertCell(4);

            id.innerHTML = "<b>Id</b>";
            name.innerHTML = "<b>Name</b>";
            surname.innerHTML = "<b>Surname</b>";
            email.innerHTML = "<b>Email</b>";
            actions.innerHTML = "<b>Actions</b>";
            loadProvidersData();
        })
    }

    function deleteProvider(i){
        $.get("{{ URL::to('admin/deleteprovider') }}", {id: parseInt(i)},function (data){
            $("#providertable tr").remove();
            var table = document.getElementById("providertable");
            var row = table.insertRow(0);

            var id = row.insertCell(0);
            var name = row.insertCell(1);
            var surname = row.insertCell(2);
            var email = row.insertCell(3);
            var actions = row.insertCell(4);

            id.innerHTML = "<b>Id</b>";
            name.innerHTML = "<b>Name</b>";
            surname.innerHTML = "<b>Surname</b>";
            email.innerHTML = "<b>Email</b>";
            actions.innerHTML = "<b>Actions</b>";
            loadProvidersData();
        })
    }

    function deleteHuman(i){
        $.get("{{ URL::to('admin/deletehuman') }}", {id: parseInt(i)},function (data){
            $("#humantable tr").remove();
            var table = document.getElementById("humantable");
            var row = table.insertRow(0);

            var id = row.insertCell(0);
            var name = row.insertCell(1);
            var surname = row.insertCell(2);
            var email = row.insertCell(3);
            var actions = row.insertCell(4);

            id.innerHTML = "<b>Id</b>";
            name.innerHTML = "<b>Name</b>";
            surname.innerHTML = "<b>Surname</b>";
            email.innerHTML = "<b>Email</b>";
            actions.innerHTML = "<b>Actions</b>";
            loadHumansData();
        })
    }
</script>
@endsection
