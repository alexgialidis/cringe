@extends ('layout')

@section ('content')

<style>
input{
  height: 32px;
}
</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
var dds, mms, yyyys;
if(dd<10) {
    dd = '0'+dd
    if (dd> 27) {
        dds= "27";
        if (dds<10) dds= '0' + dds;
    }
    else dds= dd;
}

if(mm<10) {
    mm = '0'+mm
    if (mm != 1) {
        mms=mm-1;
        if (mms<10) mms= '0' + mms;
        yyyys= yyyy;
    }
    else {
        mms= 12;
        yyyys= yyyy-1;
    }
}
var def_end= yyyy + "-" + mm + "-" + dd;
var def_start= yyyys + "-" + mms + "-" + dds;
 $(document).ready(function() {
     document.getElementById('end_date').value = def_end;
     document.getElementById('start_date').value = def_start;
     load();
     loadHistoryData();
  });
var start;
var end;
function load(){
		var ticketsData= [];
		var moneyData= [];
		var titles=[];
		start=document.getElementById('start_date').value;
		end= document.getElementById('end_date').value;

		if (!start) {
            document.getElementById('start_date').value = def_start;
            start= def_start;
        }
        if (!end) {
            document.getElementById('end_date').value = def_end;
            end= def_end;
        }
        $('#historydata').empty();
		$.get("{{ URL::to('events/loadstats') }}", {start: start, end: end},function (data){
			$.each(data, function(i,value){
				ticketsData.push({y: value.sold, label: value.title});
				moneyData.push({y: value.sold * value.price, label: value.title});
                loadHistoryData(value);
			})
			//console.log(ticketsData, moneyData, start, end);
			plot(ticketsData, moneyData, start, end);
		})
	}
function resettable(){
    $("#historytable tr").remove();
    var table = document.getElementById("historytable");
    var row = table.insertRow(0);

    var title = row.insertCell(0);
    var date = row.insertCell(1);
    var eventdate = row.insertCell(2);
    var minage = row.insertCell(3);
    // var maxage = row.insertCell(4);
    var description = row.insertCell(4);

    title.innerHTML = "<b>Title</b>";
    date.innerHTML = "<b>Date</b>";
    minage.innerHTML = "<b>Age Range</b>";
    // maxage.innerHTML = "<b>Max Age</b>";
    eventdate.innerHTML = "<b>Event Date</b>";
    description.innerHTML = "<b>Description</b>";
}

function plot(t, m, start, end) {
    // CanvasJS.addColorSet("color",
    //         [//colorSet Array
    //
    //           "#66ccff",
    // 	        "#005b9f",
    // 	        "#2439a5",
    // 	        "#1045b6"
    //         ]);
    var chart = new CanvasJS.Chart("chartContainer", {
    	animationEnabled: true,
        exportEnabled: true,
        colorSet: "color",
    	title:{
    		text: "Sold tickets and income from " + start + " to " + end,
            fontColor: "#272727"
    	},
    	axisY: {
    		title: "Number of Tickets",
    		titleFontColor: "#5675be",
    		lineColor: "#666666",
    		labelFontColor: "#666666",
    		tickColor: "#666666"
    	},
    	axisY2: {
    		title: "Income in €",
    		titleFontColor: "#c83f4b",
    		lineColor: "#666666",
    		labelFontColor: "#666666",
    		tickColor: "#666666"
    	},
    	toolTip: {
    		shared: true
    	},
    	legend: {
    		cursor:"pointer",
    		itemclick: toggleDataSeries
    	},
    	data: [{
    		type: "column",
    		name: "Number of Tickets",
    		legendText: "Number of Tickets",
    		showInLegend: true,
    		dataPoints:t
    	},
    	{
    		type: "column",
    		name: "Income in €",
    		legendText: "Income in €",
    		axisYType: "secondary",
    		showInLegend: true,
    		dataPoints:m
    	}]
    });
    chart.render();

    function toggleDataSeries(e) {
    	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    		e.dataSeries.visible = false;
    	}
    	else {
    		e.dataSeries.visible = true;
    	}
    	chart.render();
    }

    var chartPie = new CanvasJS.Chart("chartContainerPie", {
	animationEnabled: true,
    exportEnabled: true,
    colorSet: "color",
	title: {
		text: "Income Percentage Distribution from " + start + " to " + end,
        fontColor: "#272727"
	},
	data: [{
		type: "pie",
		startAngle: 240,
        yValueFormatString: ":##\"€\"",
		indexLabel: "{label} {y}",
		dataPoints: m
	}]
});
chartPie.render();
    }

    function loadHistoryData(value){
                     var tr= $("<tr/>");
                     tr.append($("<td/>", {
                         html: '<a href="url" title= "View History of the event">'+ value.title + '</a>'
                     })).append($("<td/>", {
                         text: value.date
                     })).append($("<td/>", {
                         text: value.created_at
                     })).append($("<td/>", {
                         text: value.min_age + " - " + value.max_age
                     })).append($("<td/>", {
                         text: value.description
                     }))
                     $('#historydata').append(tr);
        }
</script>

 <div class="container" style="text-align: center;">
	<div class= "row">
		<input id="start_date" type="date">
		<input id="end_date" type="date">

		<button type="button" class="btn btn-primary" id= "loadData" onclick="load()">
         <span class="glyphicon glyphicon-refresh"></span> Load Data
    </button>
    </div>
</div>
<hr>
<br> <br>
<div id="chartContainer" style="height: 450px; width: 100%;"></div>
<hr>
<br> <br>
<div id="chartContainerPie" style="height: 400px; width: 100%;"></div>
<hr>
<br> <br>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">History of Events</div>

                <div class="panel-body">
                    <table class= "table table-bordered table-striped table-condensed text-center" id= "historytable">
                        <thread>
                            <tr>
                                <th class= "text-center">Event Title</th>
                                <th class= "text-center">Date</th>
                                <th class= "text-center">Date of Event</th>
                                <th class= "text-center">Age Range</th>
                                <!-- <th class= "text-center">Max Age</th> -->
                                <th class= "text-center">Text</th>
                            </tr>
                        </thread>
                        <tbody id="historydata">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

 <!-- <script type="text/javascript" src= "/assets/js/canvasjs.min.js"></script> -->
 <!-- <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> -->
 <script type="text/javascript" src="{{ URL::asset('js/plots.js') }}"></script>
@endsection
