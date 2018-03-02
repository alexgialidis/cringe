@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in as Admin!
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function load(){
        $.get("{{ URL::to('admin/humansdb') }}", {start: start, end: end},function (data){
            $.each(data, function(i,value){
                ticketsData.push({y: value.availability, label: value.title});
                moneyData.push({y: value.availability * value.price, label: value.title})
                //console.log(data);
                //alert(document.getElementById('date').value)
                console.log(value);
            })
            console.log(ticketsData);
            plot(ticketsData, moneyData);
        })
    }
</script>
@endsection
