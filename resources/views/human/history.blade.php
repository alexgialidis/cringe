@extends ('layout')

@section ('content')

<div class="container">
<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>
        Tickets
    </h2>
    </div>
    <table class="table table-fixed">
      <thead>
        <tr>
          <th class="col-xs-2">#</th><th class="col-xs-4">Event Name</th><th class="col-xs-4">Date</th><th class="col-xs-4">Price</th><th class="col-xs-4">Num.</th><th class="col-xs-4">Total</th>
        </tr>
      </thead>
      <tbody>
          <?php $index=0; ?>
          @foreach($tickets as $ticket)
          <tr>
             <?php $index= $index+1;
                $total= $ticket['price']* $ticket['total'];
             ?>
            <td class="col-xs-2">{{ $index }}</td><td class="col-xs-4">
                <a href= "/events/{{ $ticket['event_id'] }}">
                {{ $ticket['title'] }}</td><a>
                <td class="col-xs-4">{{ $ticket['date'] }}</td><td class="col-xs-4">{{ $ticket['price'] }}</td><td class="col-xs-2">{{ $ticket['total'] }}</td><th class="col-xs-4">{{$total}}p</th>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>







@endsection
