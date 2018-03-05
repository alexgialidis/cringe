@extends ('layout')

@section ('content')

<div class="container">
<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>
        Tickets for this Event
    </h2>
    </div>
    <table class="table table-fixed">
      <thead>
        <tr>
          <th class="col-xs-2">#</th><th class="col-xs-4">Name</th><th class="col-xs-4">Surname</th><th class="col-xs-4">email</th><th class="col-xs-4">Num.</th>
        </tr>
      </thead>
      <tbody>
          <?php $index=0; ?>
          @foreach($tickets as $ticket)
          <tr>
             <?php $index= $index+1; ?>
            <td class="col-xs-2">{{ $index }}</td><td class="col-xs-4"> {{ $ticket['name'] }}</td><td class="col-xs-4">{{ $ticket['surname'] }}</td><td class="col-xs-4">{{ $ticket['email'] }}</td><td class="col-xs-4">{{ $ticket['total'] }}</td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>







@endsection
