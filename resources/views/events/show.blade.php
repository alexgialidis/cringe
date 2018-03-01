@extends ('layout')

@section ('content')

	<h1>{{ $event['title'] }}</h1>

	<p>{{ $event['description'] }}</p>

	<button onclick="/events/{{ $event['id'] }}/buy">Buy Ticket</button>

@endsection