@extends ('layout')

@section ('content')
<script src="http://www.chartjs.org/dist/2.7.2/Chart.bundle.js"></script>
<script src="http://www.chartjs.org/samples/latest/utils.js"></script>
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
 });

function load(){
		var ticketsData= [];
		var moneyData= [];
		var titles=[];
		var start=document.getElementById('start_date').value;
		var end= document.getElementById('end_date').value;

		if (!start) {
            document.getElementById('start_date').value = def_start;
            start= def_start;
        }
        if (!end) {
            document.getElementById('end_date').value = def_end;
            end= def_end;
        }
		$.get("{{ URL::to('events/loadstats') }}", {start: start, end: end},function (data){
			$.each(data, function(i,value){
				//ticketsData.push({y: value.availability, label: value.title});
				//moneyData.push({y: value.availability * value.price, label: value.title})
				//console.log(data);
				//alert(document.getElementById('date').value);
				ticketsData.push(value.availability);
				moneyData.push(value.availability * value.price);
				titles.push(value.title);
				console.log(value);
			})
			console.log(ticketsData);
			initData(ticketsData, moneyData, titles);
		})
	}

function initData(tickets, money, titles) {
	var color = Chart.helpers.color;
	var barChartData = {
			labels: titles,
			datasets: [{
				label: 'Dataset 1',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: tickets
			}, {
				label: 'Dataset 2',
				backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
				borderColor: window.chartColors.blue,
				borderWidth: 1,
				data: money
			}]

		};
	plot(barChartData);
}
function plot(barChartData){
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myBar = new Chart(ctx, {
				type: 'bar',
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: 'Chart.js Bar Chart'
					}
				}
			});
			document.getElementById("printChart").addEventListener("click",function(){
				char.print();
			});
			document.getElementById("exportChart").addEventListener("click",function(){
				chart.exportChart({format: "jpg"});
			});
		}
var ctx = document.getElementById("myChart");
ctx.height = 500;

</script>
<div class="container">
	<div class= "row col-md-9 col-offset-2">
		<input id="start_date" type="date">
		<input id="end_date" type="date">

		<button type="button" class="btn btn-primary" id= "loadData" onclick="load()">
          <span class="glyphicon glyphicon-refresh"></span> Load Data
        </button>
		<button type="button" class="btn btn-success" id= "exportChart">
          <span class="glyphicon glyphicon-export"></span> Export Chart
        </button>
</div>
</div>
<canvas id="canvas" style= "width:500px; height:auto; "></canvas>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection
