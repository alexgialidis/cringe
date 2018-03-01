@extends ('layout')

@section ('content')

<script>

function load(){
		var ticketsData= [];
		var moneyData= [];
		var start=document.getElementById('start_date').value;
		var end= document.getElementById('end_date').value;
		$.get("{{ URL::to('events/loadstats') }}", {start: start, end: end},function (data){
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


function plot (t,m) {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Crude Oil Reserves vs Production, 2016"
	},	
	axisY: {
		title: "Αριθμός Εισητηρίων",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC"
	},
	axisY2: {
		title: "Έσοδα σε €",
		titleFontColor: "#C0504E",
		lineColor: "#C0504E",
		labelFontColor: "#C0504E",
		tickColor: "#C0504E"
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
		name: "Events",
		legendText: "Proven Oil Reserves",
		showInLegend: true, 
		dataPoints:t
	},
	{
		type: "column",	
		name: "Oil Production (million/day)",
		legendText: "Oil Production",
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

}
</script>
<div class="container">
	<div class= "row col-md-8 col-offset-2">
		<input id="start_date" type="date">
		<input id="end_date" type="date">
		<button class= "btn btn-primary" id= "loadData" onclick="load()">Load Data</button>
	</div>
</div>
<div id="chartContainer" style="height: auto; width: 100%;"></div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection