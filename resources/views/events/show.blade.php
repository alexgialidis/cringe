@extends('layout')

@section('content')

<div class="container">
	<div class="row">

		<div class ="col-md-10 col-md-offset-2">
			<div>
				<div class="panel-heading">
					<h1>{{ $event['title'] }}</h1>
				</div>
				<div class="panel-body">
					<div class="row">


						<div class=" col-md-9 col-lg-9 ">
							<table class="table table-user-information">
								<tbody>
									<tr>
										<td>Categories:</td>
										<td>{{ $event['category'] }}</td>
									</tr>
									<tr>
										<td>Date</td>
										<td>{{ $event['date'] }}</td>
									</tr>
									<tr>
										<td>Age Range</td>
										<td>{{ $event['min_age'].' - '.$event['max_age'] }}</td>
									</tr>
									<tr>
										<td>Availability</td>
										<td>{{ $event['availability'] }}</td>
									</tr>
									<tr>
										<td>Price</td>
										<td>{{ $event['price'] }} points</td>
									</tr>
									<tr>
									<tr>
										<td>Address</td>
										<td>{{ $event['address'].' '.$event['number'].', '.$event['city'] }}</td>
									</tr>
									<tr>
										<td>Description</td>
										<td>{{ $event['description'] }}</td>
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

@if($flag=="1")
	@if (Auth::guard('human')->user())
		<button type="link" class="btn btn-primary btn-lg center-block" data-toggle="modal" data-target="#myModal">Get a Ticket</button>
	@elseif (Auth::guard('provider')->user())

	@else
		<form action="/human/login">
			<button type="link" class="btn btn-primary btn-lg center-block">Get a Ticket</button>
		</form>
	@endif
@endif
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h1 class="modal-title">Buy Ticket for {{ $event['title'] }}</h1>
        </div>
        <div class="modal-body">
          <p id ="line1"></p>
		  <p id= "line2"></p>
		  <p id= "line3"></p>
		  <p id= "line4"></p>
        </div>
        <div class="modal-footer">
			<form action="/events/{{ $event['id'] }}/buy">
          		<button type="link" class="btn btn-lg btn-primary center-block" id="proceed">Proceed</button>
			</form>
        </div>
      </div>

    </div>
  </div>
@if (Auth::guard('human')->user())

<script type="text/javascript">
var line1= document.getElementById("line1");
var line2= document.getElementById("line2");
var line3= document.getElementById("line3");


$('#myModal').on('shown.bs.modal', function (e) {
	if ({{ Auth::guard('human')->user()->lock }}== "1"){
		line1.innerHTML= "<span class='glyphicon glyphicon-lock'></span> Hm... You have locked by Admin!!! "
		line2.innerHTML= "Contact with cringeTeam@contact.com for more details"
		document.getElementById("proceed").disabled = true;
	}
	else if (parseFloat({{ $event['price'] }}) > parseFloat({{ Auth::guard('human')->user()->points }})){
		line1.innerHTML="Price: {{ $event['price'] }}";
		line2.innerHTML= "Your Points: {{ Auth::guard('human')->user()->points }} ";
		line3.innerHTML="You dont have enough points to Buy this ticket!";
		document.getElementById("proceed").disabled = true;
	}
	else{
		var total= parseFloat({{ Auth::guard('human')->user()->points }}).toFixed(2) - 0.97*parseFloat({{ $event['price'] }}).toFixed(2);
		line1.innerHTML="Your Points: {{ Auth::guard('human')->user()->points }}";
		line2.innerHTML= "Price: - {{ $event['price'] }} ";
		line3.innerHTML= "New Total: " + total.toFixed(2);
		line4.innerHTML= "Bonus: " + (0.03 * parseFloat({{ $event ['price']}})).toFixed(2);
		line1.style.color = "green";
		line2.style.color = "red";
		line3.style.color = "blue";
		line4.style.color = "green";

	}

})
</script>

@endif
@endsection
